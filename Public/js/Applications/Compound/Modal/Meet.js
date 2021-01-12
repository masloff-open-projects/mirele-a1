Application.Components.Compound.Meet = Vue.component('modal-edit-component', {
    data: function () {
        return {}
    },
    methods: {
        next: function (event) {

        },
    },
    template: `
        <div>
            <div class="__compound_modal_body">
               
                <div class="width-100 center">
                    <h1> Welcome </h1>
                </div>
                  
            </div>
            
            <div class="__compound_modal_footer">
                <a :class="['button', 'button-primary', 'right']" @click="next">Next</a>
            </div>
                      
        </div> 
    `
});