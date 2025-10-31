<template>
<div class="category_card" :style="{backgroundColor: bg || '#f7f7f7'}">
    <img :src="image" :alt="title">
    <h4>{{ title }}</h4>
    <p>{{ count }} items</p>
    
</div>
</template>
<script>

export default{
    name :"Category",
    props: {
        title: String,
        image: String,
        count: Number,
        bg: String
    }
}

</script>


<style scoped>

.category_card{
    width: 120px;
    text-align: center;
    background-color: #f9f9f9;
    border-radius: 10px;
    padding: 10px;
}

.category_card img{
    width: 60px;
    height: 60px;
    object-fit: cover;
}

.category_card p{
    opacity: 0.3;
}


</style>