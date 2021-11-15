<template>
  <div class="bg-gray-100">
            <div class="bg-white dark:bg-gray-800 text-black dark:text-gray-200 p-4">
                <div class="bg-gray-100 dark:bg-gray-700 rounded-3xl px-4 pt-2 pb-2.5">
                    <div class="font-semibold text-sm leading-relaxed">
                        {{ comment.user.name }}
                    </div>
                    <div>
                        <input v-model="newComment"
                            :readonly="!updateClicked" 
                            class="text-normal leading-snug md:leading-normal"
                            type="text">
                            <!-- {{ comment.comment}} -->
                        <small v-show="updateClicked"
                               @click="updateComment"
                               class="ml-2 hover:underline">save</small>
                    </div>
                    <div>
                        <small v-if="comment.user_id == login_user_id" 
                            class="hover:underline" 
                            @click="enableUpdate" >update</small>

                        <small v-if="comment.user_id == login_user_id" > · </small>

                        <small v-if="comment.user_id == login_user_id" 
                            class="hover:underline" 
                            @click="deleteComment" >delete</small>
                    </div>
                </div>

                    <div class="text-sm ml-4 mt-0.5 text-gray-500 dark:text-gray-400">
                        {{ comment.updated_at }}
                    </div>
                </div>
            </div>
</div>
</template>

<script>
export default{
    props:['comment', 'login_user_id'],
    data() {
        return {
            newComment:'',
            updateClicked:false,
        }
    },
    methods:{
        deleteComment() {
            if(confirm('Are you sure?')){
                axios.delete('/comments/' + this.comment.id)
                    .then(response=> {
                        // this.$$emit('deleted'); // 1
                        this.$parent.getComments(); // 2
                }).catch(err=>{
                    console.log(err);
                });
                    Swal.fire({ // sweet alert
                        position: 'top-center',
                        icon: 'success',
                        title: 'Comment was deleted',
                        showConfrimButton: false,
                        timer: 1500
                    })
            }
        },
        enableUpdate(){
            this.updateClicked = true;
        },
        updateComment() {
            if(this.newComment == ''){
                alert('Blank input');
                return; // 서버측에 요청을 막아줌.
            }
            axios.patch('/comments/'+this.comment.id, {
                'comment' : this.newComment
            }).then(response => {
                this.updateClicked = false;
                Swal.fire({ // sweet alert
                    position: 'top-center',
                    icon: 'success',
                    title: 'New comment updated.',
                    showConfrimButton: false,
                    timer: 1500
                })
            }).catch(err => {
                console.log(err);
            })
        }
    },        
    created() {
            this.newComment = this.comment.comment;
        },
}
</script>