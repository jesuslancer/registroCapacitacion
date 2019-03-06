<template>
<div>

    <datepicker @input="$emit('input', $event)" :value="value" :language="es" ></datepicker>    
</div>

</template>
<script>
import Datepicker from 'vuejs-datepicker';
import { es } from 'vuejs-datepicker/dist/locale'
export default {
  props:['value'],
  data(){
    return {
        es:es,
    }
  },
  components:{
  Datepicker
  }
  
}

</script>
