<template>
    <div class="tabs-panel is-active" id="fuel-expenses-logs">
    <table class="dashboard-table">

        <colgroup>


        </colgroup>



        @if($expenses->count() !== 0)

            <thead>

            <tr>
                <th class='text-left'><a href="#">Date <i class="fa fa-caret-down"></i></a></th>
                <th class='text-center'><a href="#">Quantity <i class="fa fa-caret-down"></i></a></th>
                <th class='text-right'><a href="#">Cost <i class="fa fa-caret-down"></i></a></th>

            </tr>
            </thead>

            <tbody>


            @foreach($expenses as $expense)


                @include('vehicle.expense-template')

            @endforeach



            </tbody>

        @else

            <tr>
                <td colspan="3">
                    <div class="callout secondary">

                        <h4 class="text-center">
                            You have no fuel expenses to show.
                        </h4>

                    </div>
                </td>
            </tr>
        @endif
    </table>



</div>
</template>


<script>
export default {
        name: "expenses-historic",
        data(){
            return {
                
            }
        },
        created(){
            fetch('/api/expenses/historic?api_token=04e05d12ddf962c9e3c371baaf527f9f9469a0b5590792d003032823883d0cc13cfcdd439853cc9c').then( response => console.log(response)  )
        },

        methods:{

        }
}
</script>
