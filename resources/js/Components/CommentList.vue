<template>
<div class="shadow-lg">
            <label class="block text-left"> 
                <input type="text" v-model="newComment" class="form-control">
            </label>
            <input type="submit" @click="addComment" class="btn btn-primary">

            <button class="btn btn-primary" @click="getComments">Reading Comments</button>
                <comment-item v-for="comment in comments.data" :key="comment.id" :comment="comment" :login_user_id="loginuser" @deleted="getComments" />
        
            <pagination @pageClicked="getPage($event)"
                v-if="comments.data !=null" :links="comments.links"></pagination>
</div>

</template>

<script>
import CommentItem from "./CommentItem.vue";
import Pagination from "./Pagination.vue";

export default {
    props: ['post', 'loginuser'],
    components: {CommentItem, Pagination},
    data(){
        return {
            comments:[],
            newComment : '',
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
        addComment(){
            axios.post('/comments/'+this.post.id, {'comment':this.newComment})
            .then(response=> {
                console.log(response.data);
                this.getComments();
                this.newComment="";
            })
            .catch(err=> {
                console.log(err);
            })
                if (this.newComment == ""){
                alert('blank input...');
                // return false;
            }
        },
        getPage(url) {
            console.log(url);
            axios.get(url)
            .then(response=>{
                this.comments = response.data;
                // console.log(response);
            }).catch(err=>{
                console.log(err);
            })
        }
    }
}
</script>