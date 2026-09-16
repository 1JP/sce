@extends('layouts.email-admin')

@section('content')
<table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="600" id="emailBody">
    <!-- MODULE ROW // -->
    <!--
                      To move or duplicate any of the design patterns
                      in this email, simply move or copy the entire
                      MODULE ROW section for each content block.
                  -->
    <tbody>
      <tr>
        <td align="center" valign="top">
          <!-- CENTERING TABLE // -->
          <!--
                              The centering table keeps the content
                              tables centered in the emailBody table,
                              in case its width is set to 100%.
                          -->
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="color:#FFFFFF;" bgcolor="#000">
            <tbody>
              <tr></tr>
            </tbody>
          </table>
          <!-- // CENTERING TABLE -->
        </td>
      </tr>
      <!-- // MODULE ROW -->
      <!-- MODULE ROW // -->
      <!--  The "mc:hideable" is a feature for MailChimp which allows
                      you to disable certain row. It works perfectly for our row structure.
                      http://kb.mailchimp.com/article/template-language-creating-editable-content-areas/
                  -->
      <tr mc:hideable="">
        <td align="center" valign="top">
          <!-- CENTERING TABLE // -->
          <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#F7F7F7">
            <tbody>
              <tr>
                <td align="center" valign="top">
                  <!-- FLEXIBLE CONTAINER // -->
                  <table border="0" cellpadding="0" cellspacing="0" width="600" class="flexibleContainer">
                    <tbody>
                      <tr>
                        <td valign="top" width="600" class="flexibleContainerCell">
                          <!-- CONTENT TABLE // -->
                          <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                              <tr>
                                <td align="center" valign="top" class="flexibleContainerBox">
                                  <table border="0" cellpadding="0" cellspacing="0" width="90" style="max-width:100%;">
                                    <tbody>
                                      <tr>
                                        <td align="left" class="textContent">
                                          <img src="{{ asset('site/img/logo-sce.jpeg') }}" align="left" style="height: 40px;padding-bottom:24px;padding-top:24px;">
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <!-- // CONTENT TABLE -->
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- // FLEXIBLE CONTAINER -->
                </td>
              </tr>
            </tbody>
          </table>
          <!-- // CENTERING TABLE -->
        </td>
      </tr>
      <!-- // MODULE ROW -->
      <!-- MODULE ROW // -->
      <tr>
        <td align="center" valign="top">
          <!-- CENTERING TABLE // -->
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
              <tr style="padding-top:0;"></tr>
            </tbody>
          </table>
          <!-- // CENTERING TABLE -->
        </td>
      </tr>
      <!-- // MODULE ROW -->
      <!-- MODULE ROW // -->
      <tr>
        <td align="center" valign="top">
          <!-- CENTERING TABLE // -->
          <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF">
            <tbody>
              <tr>
                <td valign="top" align="center">
                  <!-- FLEXIBLE CONTAINER // -->
                  <table border="0" cellpadding="0" cellspacing="0" width="600" class="flexibleContainer">
                    <tbody>
                      <tr>
                        <td valign="top" class="flexibleContainerCell" align="center" width="600">
                          <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                              <tr>
                                <td align="center" valign="top">
                                  <!-- CONTENT TABLE // -->
                                  <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td valign="top" class="textContent">
                                                <!--
                                                                                    The "mc:edit" is a feature for MailChimp which allows
                                                                                    you to edit certain row. It makes it easy for you to quickly edit row sections.
                                                                                    http://kb.mailchimp.com/templates/code/create-editable-content-areas-with-mailchimps-template-language
                                                                                -->
                                                <h1 style="color:#000000;line-height:125%;font-family:Verdana,Arial,sans-serif;font-weight:normal;margin-top:30px;margin-bottom:3px;margin-left:30px;margin-right:30px;text-align:center;">Assinatura excluida com sucesso!</h1>
                                                <div style="text-align: center; font-family: Verdana, Arial, sans-serif; font-size: 16px; margin-bottom: 0px; margin-top: 20px; margin-left:30px; margin-right:30px; color: rgb(95, 95, 95); line-height: 135%;">Olá, {{ $email }} </div>
                                                <div style="text-align:left;font-family:Verdana,Arial,sans-serif;font-size:14px;margin-bottom:10;margin-top:20px;color:#3C2E2E;line-height:135%;margin-bottom: 0px; margin-top: 20px; margin-left:30px; margin-right:30px;">Informamos que a sua assinatura foi cancelada com sucesso.</div>
                                                <div style="text-align:left;font-family:Verdana,Arial,sans-serif;font-size:14px;margin-bottom:10;margin-top:20px;color:#3C2E2E;line-height:135%;margin-bottom: 0px; margin-top: 20px; margin-left:30px; margin-right:30px;">Detalhes do plano cancelado:</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top">
                                                <!-- FLEXIBLE CONTAINER // -->
                                                <div style="text-align:left;font-family:Verdana,Arial,sans-serif;font-size:14px;margin-bottom:10;margin-top:3px;color:#3C2E2E;line-height:135%; margin-bottom: 0px; margin-top: 20px; margin-left:30px; margin-right:30px;">Plano</div>
                                                <div style="text-align:left;font-family:Verdana,Arial,sans-serif;font-size:16px;margin-bottom:0;margin-top:3px;color:#3C2E2E;line-height:135%;margin-bottom: 20px; margin-top: 0px; margin-left:30px; margin-right:30px;"><b>{{ $plan }}</b> </div>
                                                <div style="text-align:left;font-family:Verdana,Arial,sans-serif;font-size:14px;margin-bottom:10;margin-top:20px;color:#3C2E2E;line-height:135%;margin-bottom: 0px; margin-top: 20px; margin-left:30px; margin-right:30px;">Valor </div>
                                                <div style="text-align:left;font-family:Verdana,Arial,sans-serif;font-size:16px;margin-bottom:0;margin-top:3px;color:#3C2E2E;line-height:135%; margin-bottom: 0px; margin-top: 0px; margin-left:30px; margin-right:30px;"><b>R$ {{ number_format($value, 2, ',', '.') }}</b></div>
                                                <div style="text-align:left;font-family:Verdana,Arial,sans-serif;font-size:14px;margin-bottom:10;margin-top:20px;color:#3C2E2E;line-height:135%;margin-bottom: 0px; margin-top: 20px; margin-left:30px; margin-right:30px;">A partir de agora, não serão mais realizadas cobranças referentes a este plano. O acesso aos benefícios, incluindo o cadastro de</div>
                                                <div style="text-align:left;font-family:Verdana,Arial,sans-serif;font-size:16px;margin-bottom:0;margin-top:3px;color:#3C2E2E;line-height:135%; margin-bottom: 0px; margin-top: 0px; margin-left:30px; margin-right:30px;"><b>{{ $number_book }} livros, {{ $number_film }} filmes e {{ $number_serie }} séries, </b> será encerrado ao final do período já pago.</div>
                                                <!-- // FLEXIBLE CONTAINER -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top">
                                                <!-- FLEXIBLE CONTAINER // -->
                                                <div style="text-align:left;font-family:Verdana,Arial,sans-serif;font-size:14px;margin-bottom:10;margin-top:20px;color:#3C2E2E;line-height:135%;margin-bottom: 0px; margin-top: 20px; margin-left:30px; margin-right:30px;">Caso o cancelamento tenha sido um engano ou você deseje reativar sua assinatura, entre em contato conosco ou acesse sua conta a qualquer momento.</div>
                                                <div style="text-align:left;font-family:Verdana,Arial,sans-serif;font-size:16px;margin-bottom:0;margin-top:3px;color:#3C2E2E;line-height:135%; margin-bottom: 0px; margin-top: 0px; margin-left:30px; margin-right:30px;">Agradecemos por ter feito parte da nossa comunidade.</div>
                                                <!-- // FLEXIBLE CONTAINER -->
                                            </td>
                                        </tr>
                                    </tbody>
                                  </table>
                                  <!-- // CONTENT TABLE -->
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- // FLEXIBLE CONTAINER -->
                </td>
              </tr>
            </tbody>
          </table>
          <!-- // CENTERING TABLE -->
        </td>
      </tr>
      <!-- // MODULE ROW -->
      <!-- MODULE ROW // -->
      <tr>
        <td align="center" valign="top">
          <!-- CENTERING TABLE // -->
          <table border="0" cellpadding="30" cellspacing="0" width="100%">
            <tbody>
              <tr style="padding-top:0;">
                <td align="center" valign="top">
                  <!-- FLEXIBLE CONTAINER // -->
                  <table border="0" cellpadding="30" cellspacing="0" width="600" class="flexibleContainer">
                    <tbody>
                      <tr>
                        <td style="padding-top:0;" align="center" valign="top" width="600" class="flexibleContainerCell">
                          <!-- CONTENT TABLE // -->
                          //
                          <!-- // CONTENT TABLE -->
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- // FLEXIBLE CONTAINER -->
                </td>
              </tr>
            </tbody>
          </table>
          <!-- // CENTERING TABLE -->
        </td>
      </tr>
      <!-- // MODULE ROW -->
      <!-- // MODULE ROW -->
      <!-- MODULE ROW // -->
      <tr>
        <td align="center" valign="top">
          <!-- CENTERING TABLE // -->
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
              <tr>
                <td align="center" valign="top">
                  <!-- FLEXIBLE CONTAINER // -->
                  <table border="0" cellpadding="30" cellspacing="0" width="600" class="flexibleContainer">
                    <tbody>
                      <tr></tr>
                    </tbody>
                  </table>
                  <!-- // FLEXIBLE CONTAINER -->
                </td>
              </tr>
            </tbody>
          </table>
          <!-- // CENTERING TABLE -->
        </td>
      </tr>
      <!-- // MODULE ROW -->
    </tbody>
</table>
@endsection