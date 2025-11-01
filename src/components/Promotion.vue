<template>
<div class="promotion" :style="{ backgroundColor: bg || '#f7f7f7' }">
<img :src="image" :alt="title" class="bg-image" >
    <div class="text-area">
        <h3>{{ title }}</h3>
        <Button1 :text="buttontext" :color="buttoncolor" @click="shopnow(title)" />
    
    </div>
  
    
</div>
</template>
<script>

import Button1 from './Button.vue';

export default{
    name: "Promotion",
    components:{
        Button1
    },
    props: {
        image: String,
        title: String,
        buttontext: String,
        bg: String,
        buttoncolor: String
    },

   methods:{
      shopnow(title){
        alert("let's shop: " + title);
      },
    }
}
</script>

<style scoped>

.promotion {
  position: relative;
  width: 100%;
  height: 300px;
  border-radius: 12px;
  overflow: hidden;
  display: flex;
  align-items: center; /* Center text vertically */
  justify-content: flex-start; /* Align text to left */
}

.bg-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position:top;
  z-index: 1;
}

.text-area {
  position: relative;
  z-index: 2;
  padding: 20px;
  max-width: 30%; /* Text takes only left half */
  display: flex;
  flex-direction: column;
  justify-content: center;
  gap: 40px;
  text-align: left;
}

.text-area h3 {
  font-size: 1.2rem;
  font-weight: 600;
  color: #333;
  margin: 0;
  line-height: 1.4;
}

</style>

