<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent,watch } from "vue";
import moment from 'moment'
import {useToastr} from '../../../toastr';
import {debounce} from 'lodash';
import {Form, Field} from 'vee-validate';
import { useRouter} from "vue-router";
import * as yup from 'yup';
import VueFeather from 'vue-feather';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

let retrievedData =ref([]);
const searchQuery = ref(null);
let equipments =ref([]);
let loadingSubmit =ref([true]);
let loadingDiv =ref([true]);
const router = useRouter();
let self = this;
let account = ref([]);







const getData = async (page = 1) => {
  axios.get(`/registration/+${router.currentRoute.value.params.id}?page=${page}`, 
  {
        params:{
          query: searchQuery.value
        }
      })
       .then((response)=>{
        loadingDiv.value=false;
        retrievedData.value = response.data.registration;
        account.value = response.data.account;
        
     
       }).catch(()=>{
        loadingDiv.value=false;
       })
}

watch(searchQuery,debounce(()=>{
    getData();
},300));


onMounted(()=>{
  getData();
})
</script>

<template>
    <div v-if="!loadingDiv">

        <h1 class="h3 mb-3">Boletim de Matrícula</h1>
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Estudante: {{ retrievedData.child_full_name }}</h5>

                                        <router-link to="/admin/registration" class="btn btn-pill btn-primary mt-3"><vue-feather type="arrow-left"></vue-feather>Voltar</router-link> 

                                       
								    </div>
                                    
                                    <div class="card-body">
                                        <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Ver Conta Corrente <vue-feather type="eye"></vue-feather></a>
                                        
                                        <div class="row">
                                                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                        <div class="card card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Descrição</th>
                                                                            <th>Entidade</th>
                                                                            <th>Referência</th>
                                                                            <th>Valor a pagar</th>
                                                                            <th>Prazo</th>
                                                                            <th>Valor pago</th>
                                                                            <th>Data pagamento</th>
                                                                            <th>Estado</th>
                                                                            <th>Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody v-if="account.length > 0">
                                                                        <tr  v-for="(actualData,index) in account" :key="actualData.id">
                                                                            <td>#{{ index + 1 }}</td>
                                                                            <td>{{ actualData.tax.name}}</td>
                                                                            <td>{{ actualData.entinty}}</td>
                                                                            <td>{{ actualData.reference}}</td>
                                                                            <td>{{ actualData.amount_to_pay}}MT</td>
                                                                            <td>{{ moment(actualData.expire_at).format('DD-MM-YYYY')}}</td>
                                                                            <td><span v-if="actualData.amount_paid">{{ actualData.amount_paid}}MT</span></td>
                                                                            <td>{{ actualData.payment_date}}</td>
                                                                            <td><span class="badge bg-success" v-if="actualData.status == 1">Pago</span> <span class="badge bg-danger" v-else>Não pago</span></td>
                                                                            
                                                                            
                                                                            <td>
                                                                                <!-- <router-link :to="'/admin/taxes/'+actualData.id+'/edit'"><vue-feather type="edit-2"></vue-feather></router-link> -->
                                                                                <!-- <router-link :to="'/admin/taxes/'+actualData.id"><vue-feather type="eye"></vue-feather></router-link>  -->
                                                                                <!-- <a href="#" @click.prevent="confirmDeletion(actualData)"><vue-feather type="trash"></vue-feather></a> -->
                                                                                
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                    <tbody v-else>
                                                                        <tr>
                                                                        <td colspan="5" align="center">Nenhum resultado encontrado</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12 d-flex">
                                                <div class="w-100">
                                                   <div class="row">
                                                    <h1 class="h3 mb-3">Serviços da Secretária</h1>
                                                    <div class="mb-3 col-md-6">
                                                        
                                                        <p><strong>Nº Inscrição/Processo:  </strong>{{ retrievedData.id }}/ {{ retrievedData.schoolyear.year }}</p>
                                                        <p><strong>Ano Letivo: </strong>{{ retrievedData.schoolyear.year }}</p>
                                                        <p><strong>Inicio do Ano Letivo: </strong>{{ moment(retrievedData.start_at).format('DD-MM-YYYY')}}</p>
                                                        <p><strong>Fim Ano Letivo: </strong>{{ moment(retrievedData.end_at).format('DD-MM-YYYY')}}</p>
                                                        <p><strong>Frequencia de Pagamento: </strong>{{ retrievedData.paymentfrequency.name }}</p>

                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <div class="card-body text-center">
                                                            <img :src="retrievedData.child_image ? '/storage/'+retrievedData.child_image : '/noimage.png'" alt="lapismagico" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                                                            <!-- <h5 class="card-title mb-0">Christina Mason</h5>
                                                            <div class="text-muted mb-2">Lead Developer</div>

                                                            <div>
                                                                <a class="btn btn-primary btn-sm" href="#">Follow</a>
                                                                <a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message</a>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                   </div>
                                                   <hr class="my-0 mb-5" />
                                                   
                                                   <div class="row">
                                                        <h1 class="h3 mb-3">Identificação da Criança</h1>

                                                        <div class="mb-3 col-md-12">
                                                            <p><strong>Nome Completo :</strong> {{ retrievedData.child_full_name }}</p>
                                                            <p><strong>Sexo :</strong> {{ retrievedData.childgender.name }}</p>
                                                            <p><strong>Tipo de Documento :</strong> {{ retrievedData.childdocument.name }}</p>
                                                            <p><strong>Nº de Documento :</strong> {{ retrievedData.child_document_number }}</p>
                                                            <p><strong>Data de Nascimento :</strong> {{ moment(retrievedData.child_date_of_birth).format('DD-MM-YYYY') }}</p>
                                                            <p><strong>País :</strong> {{ retrievedData.childcountry.name }}</p>
                                                            <p><strong>Província :</strong> {{ retrievedData.childprovince.name }}</p>
                                                            <p><strong>Cidade :</strong> {{ retrievedData.childcity.name }}</p>
                                                            <p><strong>Endereço :</strong> {{ retrievedData.child_address }}</p>
                                                            <p><strong>Nº :</strong> {{ retrievedData.child_address_number }}</p>
                                                            <p><strong>Localidade :</strong> {{ retrievedData.child_address_locality }}</p>
                                                            <p><strong>Código Postal :</strong> {{ retrievedData.child_address_postal_code }}</p>
                                                            <p><strong>Nome Completo do Pai :</strong> {{ retrievedData.child_son_of_first }}</p>
                                                            <p><strong>Nome Completo da Mãe :</strong> {{ retrievedData.child_son_of_second }}</p>
                                                        </div>

                                                   </div>

                                                   <hr class="my-0 mb-5" />
                                                   
                                                   <div class="row">
                                                        <h1 class="h3 mb-3">Identificação do(a) Encarregado de Educaçao</h1>

                                                        <div class="mb-3 col-md-12">
                                                            <p><strong>Nome Completo :</strong> {{ retrievedData.sponsor_education_full_name }}</p>
                                                            <p><strong>Sexo :</strong> {{ retrievedData.sponsorgender.name }}</p>
                                                            <p><strong>Tipo de Documento :</strong> {{ retrievedData.sponsordocument.name }}</p>
                                                            <p><strong>Nº de Documento :</strong> {{ retrievedData.sponsor_education_document_number }}</p>
                                                            <p><strong>Data de Nascimento :</strong> {{ moment(retrievedData.sponsor_education_date_of_birth).format('DD-MM-YYYY') }}</p>
                                                            <p><strong>País :</strong> {{ retrievedData.sponsorcountry.name }}</p>
                                                            <p><strong>Província :</strong> {{ retrievedData.sponsorprovince.name }}</p>
                                                            <p><strong>Cidade :</strong> {{ retrievedData.sponsorcity.name }}</p>
                                                            <p><strong>Endereço :</strong> {{ retrievedData.sponsor_education_address }}</p>
                                                            <p><strong>Nº :</strong> {{ retrievedData.sponsor_education_address_number }}</p>
                                                            <p><strong>Localidade :</strong> {{ retrievedData.sponsor_education_address_locality }}</p>
                                                            <p><strong>Código Postal :</strong> {{ retrievedData.sponsor_education_address_postal_code }}</p>
                                                            <p><strong>Telefone :</strong> {{ retrievedData.sponsor_education_mobile }}</p>
                                                            <p><strong>Celular :</strong> {{ retrievedData.sponsor_education_mobile }}</p>
                                                            <p><strong>Telefone :</strong> {{ retrievedData.sponsor_education_cellphone }}</p>
                                                            <p><strong>Telefone Trabalho:</strong> {{ retrievedData.sponsor_education_work_phone }}</p>
                                                            <p><strong>Email:</strong> {{ retrievedData.sponsor_education_email }}</p>
                                                            <p><strong>Profissão:</strong> {{ retrievedData.sponsor_education_profession }}</p>
                                                            <p><strong>Local Trabalho:</strong> {{ retrievedData.sponsor_education_work_place }}</p>
                                                            <p><strong>Desenvolve a atividade profissional na área circundante ao colégia:</strong> <span v-if="retrievedData.sponsor_education_work_place_arround == 0">Não</span> <span v-else>Sim</span></p>
                                                            <p><strong>Grau Parentesco:</strong> {{ retrievedData.sponsordegree.name }}</p>
                                                            
                                                        </div>

                                                   </div>

                                                   <hr class="my-0 mb-5" />
                                                   
                                                   <div class="row">
                                                        <h1 class="h3 mb-3">Identificação do Pai</h1>

                                                        <div class="mb-3 col-md-12">
                                                            <p><strong>Nome Completo :</strong> {{ retrievedData.father_full_name }}</p>
                                                            <p><strong>Sexo :</strong> {{ retrievedData.fathergender.name }}</p>
                                                            <!-- <p><strong>Tipo de Documento :</strong> {{ retrievedData.fatherdocument.name }}</p>
                                                            <p><strong>Nº de Documento :</strong> {{ retrievedData.father_document_number }}</p> -->
                                                            <!-- <p><strong>Data de Nascimento :</strong> {{ moment(retrievedData.father_date_of_birth).format('DD-MM-YYYY') }}</p> -->
                                                            <p><strong>País :</strong> {{ retrievedData.fathercountry.name }}</p>
                                                            <p><strong>Província :</strong> {{ retrievedData.fatherprovince.name }}</p>
                                                            <p><strong>Cidade :</strong> {{ retrievedData.fathercity.name }}</p>
                                                            <p><strong>Endereço :</strong> {{ retrievedData.father_address }}</p>
                                                            <p><strong>Nº :</strong> {{ retrievedData.father_address_number }}</p>
                                                            <p><strong>Localidade :</strong> {{ retrievedData.father_address_locality }}</p>
                                                            <p><strong>Código Postal :</strong> {{ retrievedData.father_address_postal_code }}</p>
                                                            <p><strong>Telefone :</strong> {{ retrievedData.father_mobile }}</p>
                                                            <p><strong>Celular :</strong> {{ retrievedData.father_mobile }}</p>
                                                            <p><strong>Telefone :</strong> {{ retrievedData.father_cellphone }}</p>
                                                            <p><strong>Telefone Trabalho:</strong> {{ retrievedData.father_work_phone }}</p>
                                                            <p><strong>Email:</strong> {{ retrievedData.father_email }}</p>
                                                            <p><strong>Profissão:</strong> {{ retrievedData.father_profession }}</p>
                                                           
                                                            
                                                        </div>

                                                   </div>

                                                   <hr class="my-0 mb-5" />
                                                   
                                                   <div class="row">
                                                        <h1 class="h3 mb-3">Identificação da Mãe</h1>

                                                        <div class="mb-3 col-md-12">
                                                            <p><strong>Nome Completo :</strong> {{ retrievedData.mother_full_name }}</p>
                                                            <p><strong>Sexo :</strong> {{ retrievedData.mothergender.name }}</p>
                                                            <!-- <p><strong>Tipo de Documento :</strong> {{ retrievedData.motherdocument.name }}</p>
                                                            <p><strong>Nº de Documento :</strong> {{ retrievedData.mother_document_number }}</p> -->
                                                            <!-- <p><strong>Data de Nascimento :</strong> {{ moment(retrievedData.mother_date_of_birth).format('DD-MM-YYYY') }}</p> -->
                                                            <p><strong>País :</strong> {{ retrievedData.mothercountry.name }}</p>
                                                            <p><strong>Província :</strong> {{ retrievedData.motherprovince.name }}</p>
                                                            <p><strong>Cidade :</strong> {{ retrievedData.mothercity.name }}</p>
                                                            <p><strong>Endereço :</strong> {{ retrievedData.mother_address }}</p>
                                                            <p><strong>Nº :</strong> {{ retrievedData.mother_address_number }}</p>
                                                            <p><strong>Localidade :</strong> {{ retrievedData.mother_address_locality }}</p>
                                                            <p><strong>Código Postal :</strong> {{ retrievedData.mother_address_postal_code }}</p>
                                                            <p><strong>Telefone :</strong> {{ retrievedData.mother_mobile }}</p>
                                                            <p><strong>Celular :</strong> {{ retrievedData.mother_mobile }}</p>
                                                            <p><strong>Telefone :</strong> {{ retrievedData.mother_cellphone }}</p>
                                                            <p><strong>Telefone Trabalho:</strong> {{ retrievedData.mother_work_phone }}</p>
                                                            <p><strong>Email:</strong> {{ retrievedData.mother_email }}</p>
                                                            <p><strong>Profissão:</strong> {{ retrievedData.mother_profession }}</p>
                                                           
                                                            
                                                        </div>

                                                   </div>

                                                   <hr class="my-0 mb-5" />
                                                   
                                                   <div class="row">
                                                        <h1 class="h3 mb-3">Situação Anterior à Entrada no Colégio</h1>

                                                        <div class="mb-3 col-md-12">
                                                            <p><strong>Frequentou Ama :</strong> <span v-if="retrievedData.attended_nanny == 0">Não</span> <span v-else>Sim</span></p>
                                                            <p><strong>Frequentou Creche :</strong> <span v-if="retrievedData.attended_day_care == 0">Não</span> <span v-else>Sim</span></p>
                                                            <p><strong>Frequentou o Ensino pré escolar :</strong> <span v-if="retrievedData.attended_pre_school == 0">Não</span> <span v-else>Sim</span></p>
                                                            <p><strong>Estabelecimento e Ano :</strong> {{retrievedData.institute_name}}</p>
                                                            
                                                           
                                                        </div>

                                                   </div>

                                                   <hr class="my-0 mb-5" />
                                                   
                                                   <div class="row">
                                                        <h1 class="h3 mb-3">Situação Educativas Especiais</h1>

                                                        <div class="mb-3 col-md-12">
                                                            <p><strong>Necessidades Educativas Especiais :</strong> <span v-if="retrievedData.special_needs == 0">Não</span> <span v-else>Sim</span></p>
                                                            <p><strong>Necessidades Educativas Especiais :</strong> {{retrievedData.special_needs_info}}</p>
                                                            <p><strong>Documentos Comprovativos da Situação :</strong> <span v-if="retrievedData.delivered_support_documents == 0">Não</span> <span v-else>Sim</span></p>
                                                            <p><strong>Serviço que elaborou :</strong> {{retrievedData.delivered_support_documents_info}}</p>
                                                           
                                                        </div>

                                                   </div>

                                                   <hr class="my-0 mb-5" />
                                                   
                                                   <div class="row">
                                                        <h1 class="h3 mb-3">Médico Assistente</h1>

                                                        <div class="mb-3 col-md-12">
                                                            
                                                            <p><strong>Nome completo :</strong> {{retrievedData.assistant_doctor_full_name}}</p>
                                                            <p><strong>Local da Consulta :</strong> {{retrievedData.consultation_location}}</p>
                                                            <p><strong>Telefone :</strong> {{retrievedData.assistant_doctor_mobile}}</p>
                                                            <p><strong>Email :</strong> {{retrievedData.assistant_doctor_email}}</p>
                                                           
                                                        </div>

                                                   </div>

                                                   <hr class="my-0 mb-5" />
                                                   
                                                   <div class="row">
                                                        <h1 class="h3 mb-3">Autorização de Saída</h1>

                                                        <div class="mb-3 col-md-12">
                                                            <p v-if="retrievedData.authorized_person_1"><strong>Nome completo :</strong> {{retrievedData.authorized_person_1}} , Grau: {{retrievedData.authorized_person_1}}</p>
                                                            <p v-if="retrievedData.authorized_person_2"><strong>Nome completo :</strong> {{retrievedData.authorized_person_2}} , Grau: {{retrievedData.authorized_person_2}}</p>
                                                            <p v-if="retrievedData.authorized_person_3"><strong>Nome completo :</strong> {{retrievedData.authorized_person_3}} , Grau: {{retrievedData.authorized_person_3}}</p>
                                                            <p v-if="retrievedData.authorized_person_4" ><strong>Nome completo :</strong> {{retrievedData.authorized_person_4}} , Grau: {{retrievedData.authorized_person_4}}</p>
                                                            <p v-if="retrievedData.authorized_person_5"><strong>Nome completo :</strong> {{retrievedData.authorized_person_5}} , Grau: {{retrievedData.authorized_person_5}}</p>
                                                        </div>

                                                   </div>
                                                </div>
                                            </div>
                                        </div>
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