<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary sticky-top">
        <div class="container">
            <!-- Botão para expandir/colapsar o menu no mobile -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10" aria-controls="navbar10" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-fw mr-1 fa-file-word-o"></span>
            </button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10" aria-controls="navbar10" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-fw mr-1 fa fa-print"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar10">
                <!-- Título -->
                <b class="text-light mr-auto">Exportar como:</b>
                <!-- Botões -->
                <a id="export" class="btn btn-outline-light my-1 my-md-0 m-2" href="#" @click.prevent="exportToWord">
                    <i class="fa fa-fw mr-1 fa-file-word-o"></i>Word
                </a>
                <a id="export-pdf" class="btn btn-outline-light my-1 my-md-0" href="#" @click.prevent="printReport">
                    <i class="fa fa-fw mr-1 fa fa-print"></i>Impressão
                </a>
            </div>
        </div>
    </nav> 
</template>

<script>
    export default {
        props: {
            name_report: {
                type: String,
                required: true
            }
        },
        data(){
            return {
                //
            }
        },
        methods: {
            printReport() {
                window.print();
            },
            exportToWord() {
                const report = document.getElementById('report-content');

                if (!report) {
                    return;
                }

                const exportReport = report.cloneNode(true);

                Array.from(exportReport.querySelectorAll('.row')).reverse().forEach((row) => {
                    const table = document.createElement('table');
                    const tbody = document.createElement('tbody');
                    let tableRow = document.createElement('tr');
                    let occupiedColumns = 0;

                    table.className = row.className;
                    table.style.width = '100%';
                    table.style.tableLayout = 'fixed';
                    table.style.borderCollapse = 'collapse';

                    Array.from(row.children).forEach((column) => {
                        const desktopColumn = Array.from(column.classList)
                            .find((className) => className.match(/^col-md-\d+$/));
                        const tabletColumn = Array.from(column.classList)
                            .find((className) => className.match(/^col-sm-\d+$/));
                        const mobileColumn = Array.from(column.classList)
                            .find((className) => className.match(/^col-\d+$/));
                        const columnClass = desktopColumn || tabletColumn || mobileColumn;
                        const columnSize = columnClass ? columnClass.split('-').pop() : null;
                        const columnUnits = Number(columnSize) || 12;

                        const cell = document.createElement('td');
                        cell.className = Array.from(column.classList)
                            .filter((className) => !className.match(/^col(-md)?-\d+$/))
                            .join(' ');
                        cell.innerHTML = column.innerHTML;
                        cell.style.verticalAlign = 'top';

                        if (occupiedColumns + columnUnits > 12) {
                            tbody.appendChild(tableRow);
                            tableRow = document.createElement('tr');
                            occupiedColumns = 0;
                        }

                        cell.style.width = `${(columnUnits / 12) * 100}%`;
                        tableRow.appendChild(cell);
                        occupiedColumns += columnUnits;
                    });

                    if (tableRow.children.length) {
                        tbody.appendChild(tableRow);
                    }
                    table.appendChild(tbody);
                    row.replaceWith(table);
                });

                const styles = Array.from(document.styleSheets)
                    .map((styleSheet) => {
                        try {
                            return Array.from(styleSheet.cssRules)
                                .map((rule) => rule.cssText)
                                .join('\n');
                        } catch (error) {
                            return '';
                        }
                    })
                    .join('\n');
                const documentContent = `<!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset="utf-8">
                            <style>
                                ${styles}
                                .row { display: table !important; width: 100% !important; table-layout: fixed !important; }
                                .row > [class*="col-"] { display: table-cell !important; float: none !important; vertical-align: top !important; }
                                .col-md-12 { width: 100% !important; }
                                .col-md-9 { width: 75% !important; }
                                .col-md-2 { width: 16.666667% !important; }
                                .col-md-1 { width: 8.333333% !important; }
                                .col-12 { width: 100% !important; }
                                .col-6 { width: 50% !important; }
                                .col-4 { width: 33.333333% !important; }
                                .col-3 { width: 25% !important; }
                            </style>
                        </head>
                        <body>${exportReport.outerHTML}</body>
                    </html>`;
                const blob = new Blob([documentContent], { type: 'application/msword' });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');

                link.href = url;
                link.download = `${this.name_report}.doc`;
                link.click();
                URL.revokeObjectURL(url);
            }
        }
    }
</script>
