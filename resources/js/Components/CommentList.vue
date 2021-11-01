<template>
    <div>
        <input type="text" name="write" class="form-control" required/>
        <button class="btn btn-primary" @click="getComments">Reading Comments</button>
        <comment-item v-for="(comment, index) in comments" 
                                :key="index" :comment="comment"
                                @deleted="getConfirms"/>
    </div>
</template>

<script>
import CommentItem from "./CommentItem.vue";

export default {
    props: ['post', 'loginuser'],
    components: {CommentItem},
    data(){
        return {
            comments:[],
        }
    },
    methods:{
        getComments(){
            // this.comments=['1st comment', '2nd comment', 
            //                 '3rd comment', '4th comment', '5th comment'];
            // 서버에 현재 개시글의 댓글 리스트를 비동기적으로 요청.
            // axios
            axios.get('/comments/'+this.post.id)
            .then(response=>{
                this.comments = response.data;
                // console.log(response);
            }).catch(err=>{
                console.log(err);
            })
        },
        getConfirms(){
            axios.get('/comments'+this.comment.id)
            .then(response=>{
                confirm("Are you sure?");
            }).catch(err)
        }
    }
}
</script>