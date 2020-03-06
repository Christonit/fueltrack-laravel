export default {
    methods:{
        fetchGet(url){
            fetch(url).then( response => response.text()).then( data => JSON.parse(data))
        }
    }
}