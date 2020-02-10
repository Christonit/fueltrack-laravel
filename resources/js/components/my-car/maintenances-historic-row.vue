<template>

    <div @click="tableIsActive" ref='maintenance_table'>
        <div class="table-expand-row" data-open-details >
                    <div>
                        <div class="maintenance-logs-resume">
                            <span class="maintenance-category">
                            <i class="service-icon">
                                <slot name="service-icon"></slot>
                            </i>
                            
                            </span>

                            <span class="maintenance-service">
                                <b><slot name="maintenance-service"></slot></b>

                                <p  v-if="dueMoment == 'Specific distance'">
                                At {{ overdueDistance +trackedDistance }}  miles | {{ datePerformed }}
                                </p>

                                <p v-else-if=" dueMoment == 'Specific date' || dueMoment == 'Inmediate' ">
                                performed in {{ datePerformed}}

                                </p>
                            </span>

                            <span class="hollow-label-large text-right maintenance-cost"><slot name="cost"></slot></span>

                            <div class="maintenance-options-btn "><i class="material-icons">
                            more_vert
                            </i>
                            <div class="button-hover-reveal">
                            <a :href='"/my-maintenance/"+serviceId+"/edit"' class="">Edit</a>
                            <a :href='"/my-maintenance/"+serviceId+"/delete"'>Delete</a>
                            </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-expand-row-content">
                    <div colspan="8" class="table-expand-row-nested">
                        <div class="grid-x">
                            <p class="small-6"><b>Tracked miles</b> {{trackedDistance}}</p>
                            <p class="small-6"><b>Miles overdue</b> {{overdueDistance}}</p>
                            <p class="small-12"><b>Workshop</b> <slot name="workshop"></slot></p>
                            <p class="small-12"><b>Details</b><br> <slot name="details"></slot></p>
                        </div>
                    </div>
                </div>
    </div>
    
         


</template>

    <script>
    export default {
            name: "maintenances-historic-row",
            props:{
                dueMoment:String,
                serviceId:Number,
                overdueDistance:Number,
                trackedDistance:Number,
                datePerformed:String
            },
            data(){
                return {
                
                }
            },
            created(){
            },

            methods:{
                tableIsActive(e){
                    let tableToExpand = this.$refs.maintenance_table.lastElementChild;
                    tableToExpand.classList.contains('is-active') ? tableToExpand.classList.remove('is-active') : tableToExpand.classList.add('is-active')
                }
            }
    }
    </script>
  