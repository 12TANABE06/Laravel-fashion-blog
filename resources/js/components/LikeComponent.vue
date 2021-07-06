<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <button>いいね</button>
                <p>いいね数</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['post'],
        mounted() {
            console.log(this.post);
        }
    }
</script>
