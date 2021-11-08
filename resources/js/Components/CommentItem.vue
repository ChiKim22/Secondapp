<template>
  <div class="bg-gray-100">
            <div class="bg-white dark:bg-gray-800 text-black dark:text-gray-200 p-4">
                <div class="bg-gray-100 dark:bg-gray-700 rounded-3xl px-4 pt-2 pb-2.5">
                    <div class="font-semibold text-sm leading-relaxed">
                        {{ comment.user.name }}
                    </div>
                    <div class="text-normal leading-snug md:leading-normal">
                        {{ comment.comment}}
                    </div>
            </div>
                    <div class="text-sm ml-4 mt-0.5 text-gray-500 dark:text-gray-400">
                        {{ comment.updated_at }}
                    </div>
        </div>
</div>
</template>
<script>
export default{
    props:['comment'],
}
</script>