<template>
<div>

    <datepicker :language="es" ></datepicker>    
</div>

</template>
<script>
import Datepicker from 'vuejs-datepicker';
import { es } from 'vuejs-datepicker/dist/locale'
export default {
  data(){
    return {
        es:es
    }
  },
  components:{
  Datepicker
  }
  
}

</script>
