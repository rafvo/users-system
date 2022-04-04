<template>
  <div>
    <skeleton-loader-a v-if="loading" />
    <template v-else>
      <v-row>
        <v-col cols="12" sm="12">
          <user-modal-form-a
            v-if="isModalForm"
            v-model="userModal"
            :user-modal="userModal"
            :show-activator="showInsertButton"
          />
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12">
          <card use-title-divider use-actions-divider>
            <template slot="title">
              <span class="mr-5">Lista de Usuários</span>
              <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Pesquisar"
                single-line
                hide-details
              ></v-text-field>
            </template>
            <v-data-table :headers="cols" :items="users" :search="search">
              <template v-slot:item.name="{ item }">
                {{ item.name.toUpperCase() }}
              </template>
              <template v-slot:item.email="{ item }">
                {{ item.email }}
              </template>
              <template v-slot:item.phone="{ item }">
                {{ item.phone | phoneCelphone }}
              </template>
              <template v-slot:item.actions="{ item }">
                <user-modal-form-activator-a
                  v-if="isModalForm"
                  v-model="userModal"
                  :user-id="item.id"
                  :user-modal="userModal"
                  show-button-label
                  inline-button
                  icon-button-type
                  icon-color="orange accent-1"
                />

                <confirm-dialog-a
                  button-icon="mdi-delete"
                  button-color="red accent-1"
                  inline-button
                  @confirm="(payload) => remove(item.id)"
                >
                  <template slot="message">
                    <p>
                      Tem certeza que deseja remover o usuário
                      <strong>{{ item.name }}</strong
                      >?
                    </p>
                  </template>
                </confirm-dialog-a>
              </template>
            </v-data-table>
          </card>
        </v-col>
      </v-row>
    </template>
  </div>
</template>

<script>
import Vue from "vue";
import { Utils } from "@/util/utils";
import Modal from "@/domain/objects/modal";
import UserFilter from "@/domain/filters/users";
import SkeletonLoaderA from "@/components/loaders/SkeletonLoaderA.vue";
import Card from "@/components/card/Card.vue";
import UserModalFormA from "@/components/modal/UserModalFormA.vue";
import UserModalFormActivatorA from "@/components/modal/UserModalFormActivatorA.vue";
import ConfirmDialogA from "@/components/dialog/ConfirmDialogA.vue";

export default {
  components: {
    SkeletonLoaderA,
    Card,
    UserModalFormA,
    UserModalFormActivatorA,
    ConfirmDialogA,
  },
  props: {
    userModal: {
      type: Object,
      default: () => new Modal(),
      required: false,
    },
    userFilter: {
      type: Object,
      default: () => new UserFilter(),
      required: false,
    },
    showFilters: {
      type: Boolean,
      default: false,
      required: false,
    },
    showInsertButton: {
      type: Boolean,
      default: false,
      required: false,
    },
    isModalForm: {
      type: Boolean,
      default: false,
      required: false,
    },
  },
  data() {
    return {
      search: "",
      loading: false,
    };
  },
  computed: {
    cols() {
      return [
        {
          text: "Nome",
          align: "start",
          filterable: true,
          value: "name",
        },
        { text: "E-mail", value: "email" },
        { text: "Telefone", value: "phone" },
        { text: "Ações", value: "actions", filterable: false, sortable: false },
      ];
    },
    existUsers() {
      return Boolean(Utils.exist(this.users));
    },
    users() {
      return Object.values(this.$store.state.users.all).sort((a, b) => {
        return b.id - a.id;
      });
    },
  },
  methods: {
    getAll() {
      this.loading = true;
      this.$store
        .dispatch("users/getAll", this.userFilter)
        .then((data) => {
          this.loading = false;
        })
        .catch(() => {
          this.loading = false;
        });
    },
    remove(id) {
      if (!id) return;

      this.loading = true;
      this.$store
        .dispatch("users/remove", id)
        .then((data) => {
          this.loading = false;
        })
        .catch(() => {
          this.loading = false;
        });
    },
  },
  created() {
    this.getAll();
  },
};
</script>

<style>
</style>
