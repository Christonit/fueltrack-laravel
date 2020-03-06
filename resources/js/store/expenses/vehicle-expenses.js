export default {
    
state:{
        lastestExpenses:[]

    },
 mutations: {
        lastestExpense(state, expense){  
            state.lastestExpenses.push(expense)
            return state.lastestExpenses;
        }
    },

 getters: {

},

 actions:{
        fetchLastExpense(context){
             fetch('/latest-expense').then( response => response.json()).then( data =>{
        

                return context.commit('lastestExpense',data)

            })

            return;
        }
    }



}