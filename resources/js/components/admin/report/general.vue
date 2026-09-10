<template>
    <admin-report-nav/>
    <div id="report-content">
        <ReportSummary 
            :title="'Relatório Geral'"
            :postName="post.name"
            :indicativa="post.indicative_rating.name"
            :category="post.category.name"
            :note="post.note"
            :likes="post.likes_percentage"
            :dislikes="post.dislikes_percentage"
            :positiveComments="post.positive_comments_percentage"
            :negativeComments="post.negative_comments_percentage"
            :neutralComments="post.neutral_comments_percentage"
            :description="post.description"
        />
        <PostEngagementStats 
            :likes="post.likes_total"
            :dislikes="post.dislikes_total"
            :comments="post.total_comments"
        />
        <MostCommentedPosts
            v-if="post.most_commented_comments?.length"
            :title="'10 Comentários Mais Comentados'"
            :comments="post.most_commented_comments"
        />
        <MostCommentedPosts
            v-if="post.positive_comments?.length"
            :title="'10 Comentários Positivos'"
            :comments="post.positive_comments"
        />
        <MostCommentedPosts
            v-if="post.negative_comments?.length"
            :title="'10 Comentários Negativos'"
            :comments="post.negative_comments"
        />
        <MostCommentedPosts
            v-if="post.neutral_comments?.length"
            :title="'10 Comentários Neutros'"
            :comments="post.neutral_comments"
        />
        <admin-report-footer/>
    </div>
</template>

<script>
    import ReportSummary from './components/reportSummary.vue'
    import PostEngagementStats from './components/postEngagementStats.vue'
    import MostCommentedPosts from './components/mostCommentedPosts.vue'
    
    export default {
        components: {
            ReportSummary,
            PostEngagementStats,
            MostCommentedPosts
        },
        props: {
            post: {
                type: Object,
                required: true
            }
        },
    }
</script>
