<script setup>

import {onMounted, ref, reactive,watch} from 'vue';
import axios from 'axios';
import {useToastr} from '../../../toastr';
import {Form, Field} from 'vee-validate';
import * as yup from 'yup';
import { useRouter } from "vue-router";
import moment from 'moment'
import {debounce} from 'lodash';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';
import VueFeather from 'vue-feather';

const loading = ref(false);
const toastr = useToastr();
const loadingDiv = ref(true);
let currentvalue = ref([]);
let provinces =ref([]);
let genders =ref([]);
let countries =ref([]);
let documents =ref([]);
let degreekinships =ref([]);
let paymentfrequencies = ref([]);
let schoolyears =ref([]);
let cities1 =ref([]);
let cities2 =ref([]);
let cities3 =ref([]);
let cities4 =ref([]);
let province_id_to_city1 = ref(0)
let province_id_to_city2 = ref(0)
let province_id_to_city3 = ref(0)
let province_id_to_city4 = ref(0)
let status = 1
let is_deleted = 0


const schema = yup.object({
    
    school_year_id: yup.string().required(),
    child_gender_id: yup.string().required(),
    child_full_name: yup.string().required(),
    child_document_id: yup.string().required(),
    child_document_number: yup.string().required(),
    child_date_of_birth: yup.string().required(),
    child_country_id: yup.string().required(),
    child_province_id: yup.string().required(),
    child_address: yup.string().required(),
    child_address_number: yup.string().required(),
    child_address_locality: yup.string().required(),
    child_address_postal_code: yup.string().required(),
    child_son_of_first: yup.string().required(),
    child_son_of_second: yup.string().required(),


  
 
});
let self = this;
const router = useRouter();

const createRecordFunction = (values, actions) => {

 
    currentvalue.value = {values};

    loading.value = true;

    const arr = Array.from(values)
    
    axios.post('/registration',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/admin/registration' });
    toastr.success('Registro criada com sucesso');
  }).catch((error)=>{
    
    loading.value = false;
    toastr.error('Erro ao adicionar. '+error.response.data.message);
    if(error.response.data.errors){
       
        actions.setErrors(error.response.data.errors);
    }
  }).finally(()=>{
    loading.value = false;
    
  })



};

const getAuxiliarData = () => {

axios.get('/auxiliar-create-registration')
     .then((response)=>{

    
      provinces.value = response.data.provinces;
      genders.value = response.data.genders;
      countries.value = response.data.countries;
      degreekinships.value = response.data.degreekinships;
      documents.value = response.data.documents;
      schoolyears.value = response.data.schoolyears;
      paymentfrequencies.value = response.data.paymentfrequencies;
     
      loadingDiv.value=false;

     


     })
     .catch((error)=>{
      toastr.error(error);
      router.push({ path: '/admin/registration' });
     })
}

const getCity1 = (city) => {
axios.get(`/auxiliar-create-registration1/${city}`)
   .then((response)=>{
    cities1.value = response.data.cities1;
   })
   .catch((error)=>{
    toastr.error(error);
    router.push({ path: '/admin/registration' });
   })
}

const getCity2 = (city) => {
axios.get(`/auxiliar-create-registration2/${city}`)
   .then((response)=>{
    cities2.value = response.data.cities2;
   })
   .catch((error)=>{
    toastr.error(error);
    router.push({ path: '/admin/registration' });
   })
}

const getCity3 = (city) => {
axios.get(`/auxiliar-create-registration3/${city}`)
   .then((response)=>{
    cities3.value = response.data.cities3;
   })
   .catch((error)=>{
    toastr.error(error);
    router.push({ path: '/admin/registration' });
   })
}

const getCity4 = (city) => {
axios.get(`/auxiliar-create-registration4/${city}`)
   .then((response)=>{
    cities4.value = response.data.cities4;
   })
   .catch((error)=>{
    toastr.error(error);
    router.push({ path: '/admin/registration' });
   })
}

onMounted(()=>{
    getAuxiliarData()
})




</script>

<template>
    <div v-if="!loadingDiv">
        <h1 class="h3 mb-3">Boletim de Matrícula</h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Formulário criação Boletim de Matrícula do sistema.</h5>

                                        <router-link to="/admin/registration" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 

                                       
								    </div>
                                    
                                    <div class="card-body">
                                            <Form @submit="createRecordFunction" :validation-schema="schema" v-slot="{ errors }">
												<div class="row">
                                                    <h5 class="h5 mb-3">Informação Geral</h5>
													<div class="mb-3 col-md-4">
														<label class="form-label" for="school_year_id">Ano Letivo</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.school_year_id}" name="school_year_id" id="school_year_id" placeholder="Ano Letivo">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="schoolyear in schoolyears" :key="schoolyear.id" :value="schoolyear.id">{{ schoolyear.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.school_year_id }}</span>
													</div>
												</div>

                                                <hr>

                                                <div class="row">
                                                    <h5 class="h5 mb-3">Identificação da Criança</h5>
													<div class="mb-3 col-md-6">
														<label class="form-label" for="child_full_name">Nome Completo</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.child_full_name}" name="child_full_name" id="child_full_name" placeholder="Nome Completo"/>
                                                        <span class="invalid-feedback">{{ errors.child_full_name }}</span>
													</div>
                                                    <div class="mb-3 col-md-1">
														<label class="form-label" for="child_gender_id">Sexo</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.child_gender_id}" name="child_gender_id" id="child_gender_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="gender in genders" :key="gender.id" :value="gender.id">{{ gender.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.child_gender_id }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="child_document_id">Tipo de Documento</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.child_document_id}" name="child_document_id" id="child_document_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="document in documents" :key="document.id" :value="document.id">{{ document.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.child_document_id }}</span>
													</div>
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="child_document_number">Nº de Documento</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.child_document_number}" name="child_document_number" id="child_document_number" placeholder="Nº do Documento"/>
                                                        <span class="invalid-feedback">{{ errors.child_document_number }}</span>
													</div>
												</div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="child_date_of_birth">Data de Nascimento</label>
														<Field type="date" class="form-control" :class="{'is-invalid':errors.child_date_of_birth}" name="child_date_of_birth" id="child_date_of_birth" placeholder="Data de Nascimento"/>
                                                        <span class="invalid-feedback">{{ errors.child_date_of_birth }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="child_country_id">País</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.child_country_id}" name="child_country_id" id="child_country_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.child_country_id }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="child_province_id">Província</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.child_province_id}" @change="getCity1(province_id_to_city1)" v-model="province_id_to_city1" name="child_province_id" id="child_province_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="province in provinces" :key="province.id" :value="province.id">{{ province.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.child_province_id }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="child_city_id">Cidade</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.child_city_id}"  name="child_city_id" id="child_city_id" aria-describedby="child_city_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="city in cities1" :key="city.id" :value="city.id">{{ city.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.child_city_id }}</span>
													</div>
                                                </div>
                                              
                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="child_address">Endereço</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.child_address}" name="child_address" id="child_address" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.child_address }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="child_address_number">Nº</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.child_address_number}" name="child_address_number" id="child_address_number" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.child_address_number }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="child_address_locality">Localidade</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.child_address_locality}" name="child_address_locality" id="child_address_locality" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.child_address_locality }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="child_address_postal_code">Código Postal</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.child_address_postal_code}" name="child_address_postal_code" id="child_address_postal_code" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.child_address_postal_code }}</span>
													</div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
														<label class="form-label" for="child_son_of_first">Nome Completo do Pai</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.child_son_of_first}" name="child_son_of_first" id="child_son_of_first" placeholder="Nome Completo do Pai"/>
                                                        <span class="invalid-feedback">{{ errors.child_son_of_first }}</span>
													</div>
                                                    <div class="mb-3 col-md-6">
														<label class="form-label" for="child_son_of_second">Nome Completo da Mãe</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.child_son_of_second}" name="child_son_of_second" id="child_son_of_second" placeholder="Nome Completo da Mãe"/>
                                                        <span class="invalid-feedback">{{ errors.child_son_of_second }}</span>
													</div>
                                                </div>

                                                <hr>

                                                <div class="row">
                                                    <h5 class="h5 mb-3">Identificação do(a) Encarregado(a) de Educação</h5>
                                                    <div class="mb-3 col-md-6">
														<label class="form-label" for="sponsor_education_full_name">Nome Completo</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.sponsor_education_full_name}" name="sponsor_education_full_name" id="sponsor_education_full_name" placeholder="Nome Completo"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_full_name }}</span>
													</div>
                                                    <div class="mb-3 col-md-1">
														<label class="form-label" for="sponsor_education_gender_id">Sexo</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.sponsor_education_gender_id}" name="sponsor_education_gender_id" id="sponsor_education_gender_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="gender in genders" :key="gender.id" :value="gender.id">{{ gender.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_gender_id }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="sponsor_education_document_id">Tipo de Documento</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.sponsor_education_document_id}" name="sponsor_education_document_id" id="sponsor_education_document_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="document in documents" :key="document.id" :value="document.id">{{ document.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_document_id }}</span>
													</div>
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="sponsor_education_document_number">Nº de Documento</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.sponsor_education_document_number}" name="sponsor_education_document_number" id="sponsor_education_document_number" placeholder="Nº do Documento"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_document_number }}</span>
													</div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="sponsor_education_date_of_birth">Data de Nascimento</label>
														<Field type="date" class="form-control" :class="{'is-invalid':errors.sponsor_education_date_of_birth}" name="sponsor_education_date_of_birth" id="sponsor_education_date_of_birth" placeholder="Data de Nascimento"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_date_of_birth }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="sponsor_education_country_id">País</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.sponsor_education_country_id}" name="sponsor_education_country_id" id="sponsor_education_country_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_country_id }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="sponsor_education_province_id">Província</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.sponsor_education_province_id}" @change="getCity2(province_id_to_city2)" v-model="province_id_to_city2" name="sponsor_education_province_id" id="sponsor_education_province_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="province in provinces" :key="province.id" :value="province.id">{{ province.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_province_id }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="sponsor_education_city_id">Cidade</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.sponsor_education_city_id}"  name="sponsor_education_city_id" id="sponsor_education_city_id" aria-describedby="sponsor_education_city_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="city in cities2" :key="city.id" :value="city.id">{{ city.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_city_id }}</span>
													</div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="sponsor_education_address">Endereço</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.sponsor_education_address}" name="sponsor_education_address" id="sponsor_education_address" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_address }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="sponsor_education_address_number">Nº</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.sponsor_education_address_number}" name="sponsor_education_address_number" id="sponsor_education_address_number" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_address_number }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="sponsor_education_address_locality">Localidade</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.sponsor_education_address_locality}" name="sponsor_education_address_locality" id="sponsor_education_address_locality" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_address_locality }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="sponsor_education_address_postal_code">Código Postal</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.sponsor_education_address_postal_code}" name="sponsor_education_address_postal_code" id="sponsor_education_address_postal_code" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_address_postal_code }}</span>
													</div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="sponsor_education_mobile">Telefone</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.sponsor_education_mobile}" name="sponsor_education_mobile" id="sponsor_education_mobile" placeholder="Telefone"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_mobile }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="sponsor_education_cellphone">Celular</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.sponsor_education_cellphone}" name="sponsor_education_cellphone" id="sponsor_education_cellphone" placeholder="Celular"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_cellphone }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="sponsor_education_work_phone">Telefone Trabalho</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.sponsor_education_work_phone}" name="sponsor_education_work_phone" id="sponsor_education_work_phone" placeholder="Telefone Trabalho"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_work_phone }}</span>
													</div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="sponsor_education_email">Email</label>
														<Field type="email" class="form-control" :class="{'is-invalid':errors.sponsor_education_email}" name="sponsor_education_email" id="sponsor_education_email" placeholder="Email"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_email }}</span>
													</div>
                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="sponsor_education_profession">Profissão</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.sponsor_education_profession}" name="sponsor_education_profession" id="sponsor_education_profession" placeholder="Profissão"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_profession }}</span>
													</div>
                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="sponsor_education_work_place">Local de Trabalho</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.sponsor_education_work_place}" name="sponsor_education_work_place" id="sponsor_education_work_place" placeholder="Local de Trabalho"/>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_work_place }}</span>
													</div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="sponsor_education_work_place_arround">Desenvolve a atividade profissional na área circundante ao colégia</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.sponsor_education_work_place_arround}" name="sponsor_education_work_place_arround" id="sponsor_education_work_place_arround">
                                                            
                                                            <option value="0">Não</option>
                                                            <option value="1">Sim</option>
                                                            
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_work_place_arround }}</span>
													</div>
                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="sponsor_education_degree_of_kinship_id">Grau de Parentesco</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.sponsor_education_degree_of_kinship_id}" name="sponsor_education_degree_of_kinship_id" id="sponsor_education_degree_of_kinship_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="degreekinship in degreekinships" :key="degreekinship.id" :value="degreekinship.id">{{ degreekinship.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.sponsor_education_degree_of_kinship_id }}</span>
													</div>
                                                </div>

                                                <hr>

                                                <div class="row">
                                                    <h5 class="h5 mb-3">Identificação do Pai</h5>
                                                    <div class="mb-3 col-md-6">
														<label class="form-label" for="father_full_name">Nome Completo</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.father_full_name}" name="father_full_name" id="father_full_name" placeholder="Nome Completo"/>
                                                        <span class="invalid-feedback">{{ errors.father_full_name }}</span>
													</div>
                                                    <div class="mb-3 col-md-1">
														<label class="form-label" for="father_gender_id">Sexo</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.father_gender_id}" name="father_gender_id" id="father_gender_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="gender in genders" :key="gender.id" :value="gender.id">{{ gender.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.father_gender_id }}</span>
													</div>
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="father_country_id">País</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.father_country_id}" name="father_country_id" id="father_country_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.father_country_id }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="father_province_id">Província</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.father_province_id}" @change="getCity3(province_id_to_city3)" v-model="province_id_to_city3" name="father_province_id" id="father_province_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="province in provinces" :key="province.id" :value="province.id">{{ province.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.father_province_id }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="father_city_id">Cidade</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.father_city_id}"  name="father_city_id" id="father_city_id" aria-describedby="father_city_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="city in cities3" :key="city.id" :value="city.id">{{ city.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.father_city_id }}</span>
													</div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="father_address">Endereço</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.father_address}" name="father_address" id="father_address" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.father_address }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="father_address_number">Nº</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.father_address_number}" name="father_address_number" id="father_address_number" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.father_address_number }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="father_address_locality">Localidade</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.father_address_locality}" name="father_address_locality" id="father_address_locality" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.father_address_locality }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="father_address_postal_code">Código Postal</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.father_address_postal_code}" name="father_address_postal_code" id="father_address_postal_code" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.father_address_postal_code }}</span>
													</div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="father_mobile">Telefone</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.father_mobile}" name="father_mobile" id="father_mobile" placeholder="Telefone"/>
                                                        <span class="invalid-feedback">{{ errors.father_mobile }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="father_cellphone">Celular</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.father_cellphone}" name="father_cellphone" id="father_cellphone" placeholder="Celular"/>
                                                        <span class="invalid-feedback">{{ errors.father_cellphone }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="father_work_phone">Telefone Trabalho</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.father_work_phone}" name="father_work_phone" id="father_work_phone" placeholder="Telefone Trabalho"/>
                                                        <span class="invalid-feedback">{{ errors.father_work_phone }}</span>
													</div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="father_email">Email</label>
														<Field type="email" class="form-control" :class="{'is-invalid':errors.father_email}" name="father_email" id="father_email" placeholder="Email"/>
                                                        <span class="invalid-feedback">{{ errors.father_email }}</span>
													</div>
                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="father_profession">Profissão</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.father_profession}" name="father_profession" id="father_profession" placeholder="Profissão"/>
                                                        <span class="invalid-feedback">{{ errors.father_profession }}</span>
													</div>
                                                   
                                                </div>

                                                <hr>

                                                <div class="row">
                                                    <h5 class="h5 mb-3">Identificação da Mãe</h5>
                                                    <div class="mb-3 col-md-6">
														<label class="form-label" for="mother_full_name">Nome Completo</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.mother_full_name}" name="mother_full_name" id="mother_full_name" placeholder="Nome Completo"/>
                                                        <span class="invalid-feedback">{{ errors.mother_full_name }}</span>
													</div>
                                                    <div class="mb-3 col-md-1">
														<label class="form-label" for="mother_gender_id">Sexo</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.mother_gender_id}" name="mother_gender_id" id="mother_gender_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="gender in genders" :key="gender.id" :value="gender.id">{{ gender.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.mother_gender_id }}</span>
													</div>
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="mother_country_id">País</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.mother_country_id}" name="mother_country_id" id="mother_country_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.mother_country_id }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="mother_province_id">Província</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.mother_province_id}" @change="getCity4(province_id_to_city4)" v-model="province_id_to_city4" name="mother_province_id" id="mother_province_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="province in provinces" :key="province.id" :value="province.id">{{ province.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.mother_province_id }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="mother_city_id">Cidade</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.mother_city_id}"  name="mother_city_id" id="mother_city_id" aria-describedby="mother_city_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="city in cities4" :key="city.id" :value="city.id">{{ city.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.mother_city_id }}</span>
													</div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="mother_address">Endereço</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.mother_address}" name="mother_address" id="mother_address" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.mother_address }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="mother_address_number">Nº</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.mother_address_number}" name="mother_address_number" id="mother_address_number" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.mother_address_number }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="mother_address_locality">Localidade</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.mother_address_locality}" name="mother_address_locality" id="mother_address_locality" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.mother_address_locality }}</span>
													</div>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="mother_address_postal_code">Código Postal</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.mother_address_postal_code}" name="mother_address_postal_code" id="mother_address_postal_code" placeholder="Endereço"/>
                                                        <span class="invalid-feedback">{{ errors.mother_address_postal_code }}</span>
													</div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="mother_mobile">Telefone</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.mother_mobile}" name="mother_mobile" id="mother_mobile" placeholder="Telefone"/>
                                                        <span class="invalid-feedback">{{ errors.mother_mobile }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="mother_cellphone">Celular</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.mother_cellphone}" name="mother_cellphone" id="mother_cellphone" placeholder="Celular"/>
                                                        <span class="invalid-feedback">{{ errors.mother_cellphone }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="mother_work_phone">Telefone Trabalho</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.mother_work_phone}" name="mother_work_phone" id="mother_work_phone" placeholder="Telefone Trabalho"/>
                                                        <span class="invalid-feedback">{{ errors.mother_work_phone }}</span>
													</div>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="mother_email">Email</label>
														<Field type="email" class="form-control" :class="{'is-invalid':errors.mother_email}" name="mother_email" id="mother_email" placeholder="Email"/>
                                                        <span class="invalid-feedback">{{ errors.mother_email }}</span>
													</div>
                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="mother_profession">Profissão</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.mother_profession}" name="mother_profession" id="mother_profession" placeholder="Profissão"/>
                                                        <span class="invalid-feedback">{{ errors.mother_profession }}</span>
													</div>
                                                   
                                                </div>

                                                <hr>

                                                <div class="row">
                                                    <h5 class="h5 mb-3">Situação anterior à entrada no colégio</h5>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="attended_nanny">Frequentou Ama</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.attended_nanny}" name="attended_nanny" id="attended_nanny">
                                                            
                                                            <option value="0">Não</option>
                                                            <option value="1">Sim</option>
                                                            
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.attended_nanny }}</span>
													</div>

                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="attended_day_care">Frequentou Creche</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.attended_day_care}" name="attended_day_care" id="attended_day_care">
                                                            
                                                            <option value="0">Não</option>
                                                            <option value="1">Sim</option>
                                                            
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.attended_day_care }}</span>
													</div>

                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="attended_pre_school">Frequentou o Ensino pré escolar</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.attended_pre_school}" name="attended_pre_school" id="attended_pre_school">
                                                            
                                                            <option value="0">Não</option>
                                                            <option value="1">Sim</option>
                                                            
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.attended_pre_school }}</span>
													</div>

                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="institute_name">Estabelecimento e Ano</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.institute_name}" name="institute_name" id="institute_name" placeholder=""/>
                                                        <span class="invalid-feedback">{{ errors.institute_name }}</span>
													</div>
                                                </div>

                                                <hr>

                                                <div class="row">
                                                    <h5 class="h5 mb-3">Situações Educativas Especiais</h5>
                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="special_needs">Necessidades Educativas Especiais</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.special_needs}" name="special_needs" id="special_needs">
                                                            
                                                            <option value="0">Não</option>
                                                            <option value="1">Sim</option>
                                                            
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.special_needs }}</span>
													</div>

                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="special_needs_info">Necessidades Educativas Especiais</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.special_needs_info}" name="special_needs_info" id="special_needs_info" placeholder=""/>
                                                        <span class="invalid-feedback">{{ errors.special_needs_info }}</span>
													</div>

                                                    <div class="mb-3 col-md-2">
														<label class="form-label" for="delivered_support_documents">Documentos Comprovativos da Situação</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.delivered_support_documents}" name="delivered_support_documents" id="delivered_support_documents">
                                                            
                                                            <option value="0">Não</option>
                                                            <option value="1">Sim</option>
                                                            
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.delivered_support_documents }}</span>
													</div>

                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="delivered_support_documents_info">Serviço que elaborou</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.delivered_support_documents_info}" name="delivered_support_documents_info" id="delivered_support_documents_info" placeholder=""/>
                                                        <span class="invalid-feedback">{{ errors.delivered_support_documents_info }}</span>
													</div>
                                                </div>

                                                <hr>
                                                <div class="row">
                                                    <h5 class="h5 mb-3">Médico(a) Assistente</h5>
                                                    <div class="mb-3 col-md-6">
														<label class="form-label" for="assistant_doctor_full_name">Nome completo</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.assistant_doctor_full_name}" name="assistant_doctor_full_name" id="assistant_doctor_full_name" placeholder="Nome Completo"/>
                                                        <span class="invalid-feedback">{{ errors.assistant_doctor_full_name }}</span>
													</div>

                                                    <div class="mb-3 col-md-6">
														<label class="form-label" for="consultation_location">Local da Consulta</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.consultation_location}" name="consultation_location" id="consultation_location" placeholder=""/>
                                                        <span class="invalid-feedback">{{ errors.consultation_location }}</span>
													</div>

                                                    
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="mb-3 col-md-6">
														<label class="form-label" for="assistant_doctor_mobile">Telefone</label>
														<Field type="number" class="form-control" :class="{'is-invalid':errors.assistant_doctor_mobile}" name="assistant_doctor_mobile" id="assistant_doctor_mobile" placeholder="Nome Completo"/>
                                                        <span class="invalid-feedback">{{ errors.assistant_doctor_mobile }}</span>
													</div>

                                                    <div class="mb-3 col-md-6">
														<label class="form-label" for="assistant_doctor_email">Email</label>
														<Field type="email" class="form-control" :class="{'is-invalid':errors.assistant_doctor_email}" name="assistant_doctor_email" id="assistant_doctor_email" placeholder=""/>
                                                        <span class="invalid-feedback">{{ errors.assistant_doctor_email }}</span>
													</div>

                                                </div>

                                                <hr>
                                                <div class="row">
                                                    <h5 class="h5 mb-3">Autorização de Saída</h5>
                                                    <div class="mb-3 col-md-8">
														<label class="form-label" for="authorized_person_1">Nome completo</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.authorized_person_1}" name="authorized_person_1" id="authorized_person_1" placeholder="Nome Completo"/>
                                                        <span class="invalid-feedback">{{ errors.authorized_person_1 }}</span>
													</div>

                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="authorized_person_1_degree_of_kinship_id">Grau</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.authorized_person_1_degree_of_kinship_id}" name="authorized_person_1_degree_of_kinship_id" id="authorized_person_1_degree_of_kinship_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="degreekinships in degreekinships" :key="degreekinships.id" :value="degreekinships.id">{{ degreekinships.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.authorized_person_1_degree_of_kinship_id }}</span>
													</div>

                                                    
                                                </div>

                                                <div class="row">

                                                    <div class="mb-3 col-md-8">
														<label class="form-label" for="authorized_person_2">Nome completo</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.authorized_person_2}" name="authorized_person_2" id="authorized_person_2" placeholder="Nome Completo"/>
                                                        <span class="invalid-feedback">{{ errors.authorized_person_2 }}</span>
													</div>

                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="authorized_person_2_degree_of_kinship_id">Grau</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.authorized_person_2_degree_of_kinship_id}" name="authorized_person_2_degree_of_kinship_id" id="authorized_person_2_degree_of_kinship_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="degreekinships in degreekinships" :key="degreekinships.id" :value="degreekinships.id">{{ degreekinships.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.authorized_person_2_degree_of_kinship_id }}</span>
													</div>

                                                    
                                                </div>

                                                <div class="row">

                                                    <div class="mb-3 col-md-8">
														<label class="form-label" for="authorized_person_3">Nome completo</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.authorized_person_3}" name="authorized_person_3" id="authorized_person_3" placeholder="Nome Completo"/>
                                                        <span class="invalid-feedback">{{ errors.authorized_person_3 }}</span>
													</div>

                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="authorized_person_3_degree_of_kinship_id">Grau</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.authorized_person_3_degree_of_kinship_id}" name="authorized_person_3_degree_of_kinship_id" id="authorized_person_3_degree_of_kinship_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="degreekinships in degreekinships" :key="degreekinships.id" :value="degreekinships.id">{{ degreekinships.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.authorized_person_3_degree_of_kinship_id }}</span>
													</div>

                                                    
                                                </div>

                                                <div class="row">

                                                    <div class="mb-3 col-md-8">
														<label class="form-label" for="authorized_person_4">Nome completo</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.authorized_person_4}" name="authorized_person_4" id="authorized_person_4" placeholder="Nome Completo"/>
                                                        <span class="invalid-feedback">{{ errors.authorized_person_4 }}</span>
													</div>

                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="authorized_person_4_degree_of_kinship_id">Grau</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.authorized_person_4_degree_of_kinship_id}" name="authorized_person_4_degree_of_kinship_id" id="authorized_person_4_degree_of_kinship_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="degreekinships in degreekinships" :key="degreekinships.id" :value="degreekinships.id">{{ degreekinships.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.authorized_person_4_degree_of_kinship_id }}</span>
													</div>

                                                    
                                                </div>

                                                <div class="row">

                                                    <div class="mb-3 col-md-8">
														<label class="form-label" for="authorized_person_5">Nome completo</label>
														<Field type="text" class="form-control" :class="{'is-invalid':errors.authorized_person_5}" name="authorized_person_5" id="authorized_person_5" placeholder="Nome Completo"/>
                                                        <span class="invalid-feedback">{{ errors.authorized_person_5 }}</span>
													</div>

                                                    <div class="mb-3 col-md-4">
														<label class="form-label" for="authorized_person_5_degree_of_kinship_id">Grau</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.authorized_person_5_degree_of_kinship_id}" name="authorized_person_5_degree_of_kinship_id" id="authorized_person_5_degree_of_kinship_id">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="degreekinships in degreekinships" :key="degreekinships.id" :value="degreekinships.id">{{ degreekinships.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.authorized_person_5_degree_of_kinship_id }}</span>
													</div>

                                                    
                                                </div>

                                                 <div class="row">
                                                    <h5 class="h5 mb-3">Declaração</h5>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="date_registration">Data de Registro</label>
														<Field type="date" class="form-control" :class="{'is-invalid':errors.date_registration}" name="date_registration" id="date_registration" placeholder="Data de Registro"/>
                                                        <span class="invalid-feedback">{{ errors.date_registration }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="date_forecast_admission">Data Prevista de Admissão</label>
														<Field type="date" class="form-control" :class="{'is-invalid':errors.date_forecast_admission}" name="date_forecast_admission" id="date_forecast_admission" placeholder="Data de Registro"/>
                                                        <span class="invalid-feedback">{{ errors.date_forecast_admission }}</span>
													</div>

                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="date_admission">Data de Admissão</label>
														<Field type="date" class="form-control" :class="{'is-invalid':errors.date_admission}" name="date_admission" id="date_admission" placeholder="Data de Registro"/>
                                                        <span class="invalid-feedback">{{ errors.date_admission }}</span>
                                                        <Field type="hidden" class="form-control" name="registration_status_id" id="registration_status_id" v-model="status"/>
                                                        <Field type="hidden" class="form-control" name="is_deleted" id="is_deleted" v-model="is_deleted"/>
													</div>
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="payment_frequency_id">Frequencia de pagametno</label>
														<Field as="select" class="form-control" :class="{'is-invalid':errors.payment_frequency_id}" name="payment_frequency_id" id="payment_frequency_id" placeholder="Ano Letivo">
                                                            <option value="" disabled>Selecionar</option>
                                                            <option v-for="paymentfrequence in paymentfrequencies" :key="paymentfrequence.id" :value="paymentfrequence.id">{{ paymentfrequence.name }}</option>
                                                        </Field>
                                                        <span class="invalid-feedback">{{ errors.payment_frequency_id }}</span>
													</div>

                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
														<label class="form-label" for="date_registration">Funcionário</label>
														<span class="form-control" >Admin</span>
													</div>
                                                </div>
                                                




                                              
												<button type="submit" class="btn btn-primary" :disabled="loading">
                                                    <div v-if="loading" class="spinner-border spinner-border-sm" role="status"></div>
                                                    <span v-else>Submeter</span>
                                                </button>
											</Form>

										</div>
                                   
								
                                </div>
                                
                            </div>
                        </div>



                        
    </div>

    <div v-else>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    Carregando Dados...
                </div>
            </div> 
        </div>
    </div>


</template>