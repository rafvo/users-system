<template>
  <div>
    <skeleton-loader-a v-if="loading" />
    <template v-else>
      <validation-observer ref="observer" v-slot="{ invalid }">
        <v-form ref="form" @submit.prevent="insert">
          <v-row class="fixed-top fixed-top-card" justify="space-between">
            <v-col md="auto">
              <template v-if="invalid && !editing && showAlertError">
                <v-alert dense outlined type="error">
                  {{ alertErrorLabel }}
                </v-alert>
              </template>
            </v-col>
            <v-col md="auto">
              <v-row>
                <v-col v-if="!editing">
                  <v-btn
                    color="primary"
                    type="submit"
                    :disabled="invalid || inserting"
                  >
                    <template v-if="inserting">
                      <v-progress-circular
                        indeterminate
                        color="white"
                      ></v-progress-circular>
                    </template>
                    <template v-else>
                      <i
                        v-if="showInsertIconLabel"
                        :class="insertIcon"
                        class="pr-2"
                      ></i>
                      <span v-if="showInsertLabel">{{ insertLabel }}</span>
                    </template>
                  </v-btn>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <user-update-form-a :user-id="userId" :user="user" :editing="editing" />
            </v-col>
          </v-row>
        </v-form>
      </validation-observer>
    </template>
  </div>
</template>

<script>
import { Utils } from "@/util/utils";
import _cloneDeep from "lodash/cloneDeep";
import SkeletonLoaderA from "@/components/loaders/SkeletonLoaderA.vue";
import User from "@/domain/model/users";
import UserUpdateFormA from "./UserUpdateFormA.vue";

export default {
  components: {
    SkeletonLoaderA,
    UserUpdateFormA,
  },
  props: {
    user: {
      type: Object,
      default: () => new User(),
      required: false,
    },
    modalForm: {
      type: Boolean,
      default: false,
      required: false,
    },
    userId: {
      type: [String, Number],
      default: null,
      required: false,
    },
    insertLabel: {
      type: String,
      default: "Cadastrar",
      required: false,
    },
    showInsertLabel: {
      type: Boolean,
      default: false,
      required: false,
    },
    showInsertIconLabel: {
      type: Boolean,
      default: false,
      required: false,
    },
    insertIcon: {
      type: String,
      default: "fa fa-plus",
      required: false,
    },
    showAlertError: {
      type: Boolean,
      default: false,
      required: false,
    },
    alertErrorLabel: {
      type: String,
      default: "Erros encontrados",
      required: false,
    },
  },
  data() {
    return {
      loading: false,
      inserting: false,
    };
  },
  computed: {
    id() {
      return this.userId;
    },
    editing() {
      return Boolean(Utils.exist(this.id));
    },
    userById() {
      if (!Utils.exist(this.id)) return new User();
      return this.$store.state.users.all[this.id];
    },
  },
  methods: {
    validate() {
      return this.$refs.observer.validate();
    },
    async insert() {
      var valid = await this.validate();
      if (!valid) return;

      this.inserting = true;
      this.$store
        .dispatch("users/insert", this.user)
        .then((data) => {
          this.emitInsert();
          this.inserting = false;
        })
        .catch((e) => {
          this.inserting = false;
          this.$refs.observer.setErrors(e);
        });
    },
    emitInsert() {
      this.$emit("insert", true);
    },
  },
  created() {
    if (this.editing) this.user.create(_cloneDeep(this.userById));
    else this.user.create(new User());
  },
};
</script>

<style scoped>
</style>