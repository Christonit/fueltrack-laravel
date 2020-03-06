export default {
    methods:{

        closeModal(e){
            let el = e.target.closest('.modal');
            return el.classList.remove('show');
        }
    }
}