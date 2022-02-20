<template>
    <v-app>
        <snack :typeSnack='typeSnack' :text="textSnack" :errors="error" :key="snackKey"/>
    <div class="parent">
        <div class="block">
            <v-form
                ref="form"
                v-model="valid"
                lazy-validation
            >
                <v-row>
                    <v-col cols="12">
                        <v-text-field
                            v-model="name"
                            solo
                            placeholder="Введите свое имя"
                            :counter="10"
                            :rules="nameRules"
                            required
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            @keypress="typ($event)"
                            v-model="phone"
                            solo
                            placeholder="Введите номер телефона"
                            :counter="11"
                            :rules="phoneRules"
                            required>

                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-textarea
                            v-model="text"
                            solo
                            name="input-7-4"
                            label="Введите текст обращения"
                            :rules="textRules"
                            required>
                        </v-textarea>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="6">
                        <v-select
                            v-model="selected"
                            :items="items"
                            item-text="name"
                            item-value="id"
                            label="Выберите куда сохранить обращение"
                            return-object
                            solo
                            persistent-hint
                            :rules="selectedRules"
                            required>
                        </v-select>
                    </v-col>
                    <v-col cols="6">
                        <v-btn
                            class="ma-2"
                            outlined
                            color="indigo"
                            @click="storeFeedback()"
                        >
                            Отправить обращение
                        </v-btn>
                        <v-icon>mdi-pencil</v-icon>

                    </v-col>
                </v-row>
            </v-form>
        </div>
    </div>
    </v-app>
</template>
<script>
import VueTelInputVuetify from "vue-tel-input-vuetify/lib/vue-tel-input-vuetify.vue"
import snack from "./snack.vue"
export default {
    name: 'app',
    components: {
        snack,
        VueTelInputVuetify,
    },
    data() {
        return {
            valid: true,
            nameRules: [
                v => !!v || 'Имя обязательно для ввода',
                v => (v && v.length <= 10) || 'Имя должно состоять максимум из 10 символов',
            ],
            phoneRules: [
                v => !!v || 'Телефон обязателен для ввода',
                v => (v && v.length == 11) || 'Телефон должен состоять из 11 цифр',
            ],
            textRules: [
                v => !!v || 'Введите текст обращения',
            ],
            selectedRules: [
                v => !!v || 'Выберите куда сохранить обращение',
            ],
            error:[],
            snackKey:0,
            name:'',
            phone:null,
            text:'',
            textSnack:'',
            typeSnack:'',
            counter: 0,
            selected: null,
            items: [{id:0,name:'База данных', slug:'db'},
                    {id:1,name:'Файл',slug:'file'},
                    {id:2,name:'Email',slug:'email'}]
        };
    },
    computed: {

    },
    mounted() {

    },
    methods: {
        validate () {
            this.$refs.form.validate()
        },
        typ: function(event){
            let keyCode = (event.keyCode ? event.keyCode : event.which);
            if ((keyCode < 48 || keyCode > 57)) {
                event.preventDefault();
            }
        },
        async storeFeedback(){
            if(this.$refs.form.validate()==true){
                const feedback={
                    name:this.name,
                    phone: this.phone,
                    text: this.text,
                    slug: this.selected['slug']
                }
                try{
                    let {data} = await axios.post(`/api/store`, feedback)
                    if(data.status==true){
                        console.log(data)
                        this.textSnack='Данные внесены успешно'
                        this.typeSnack='success'
                        this.snackKey+=1
                        setTimeout(() => {this.textSnack='';
                            this.typeSnack='';
                            this.snackKey-=1;
                            window.location.href = '/'}, 5000);

                    }
                    if(data.message){
                        this.error=[]
                        if(data.message.name){
                            data.message.name.forEach(element =>
                                this.error.push(element)
                            );
                        }
                        if(data.message.phone){
                            data.message.phone.forEach(element =>
                                this.error.push(element)
                            );
                        }
                        if(data.message.text){
                            data.message.text.forEach(element =>
                                this.error.push(element)
                            );
                        }
                        this.typeSnack='error'
                        this.snackKey+=1
                        setTimeout(() => {this.error=[];
                            this.typeSnack='';
                            this.snackKey-=1;}, 7000);
                    }

                }catch (e) {
                    this.error=[]
                    this.error.push(e.response.data.message)
                    this.typeSnack='error'
                    this.snackKey+=1
                    setTimeout(() => {this.error=[];
                        this.typeSnack='';
                        this.snackKey-=1;}, 7000);
                }
            }

        },
    }
}
</script>
<style scoped>
.parent {
    width: 100%;
    top: 0;
    left: 0;
    overflow: auto;
}

.block {
    position: absolute;
    top: 20%;
    left: 50%;
    margin: -125px 0 0 -300px;
}
</style>
