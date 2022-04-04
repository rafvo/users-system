<template>
  <div :class="{ 'inline-block': inlineActivator }">
    <template v-if="showActivator">
      <user-modal-form-activator-a :user-modal="userModal" show-button-label />
    </template>
    <modal-a
      :open-modal="open"
      :modal-label="title"
      :loading="loading"
      in-modal-body-loading
      fullscreen
      @close="open = false"
    >
      <template v-if="open">
        <user-form-a
          :user-id="userId"
          modal-form
          show-insert-label
          show-insert-icon-label
          show-alert-error
          @insert="open = false"
        />
      </template>
    </modal-a>
  </div>
</template>

<script>
import Modal from "@/domain/objects/modal";
import ModalA from "./ModalA";
import UserModalFormActivatorA from "./UserModalFormActivatorA.vue";
import UserFormA from "@/components/form/UserFormA.vue";

export default {
  components: {
    ModalA,
    UserFormA,
    UserModalFormActivatorA,
  },
  props: {
    userModal: {
      type: Object,
      default: () => new Modal(),
      required: true,
    },
    modalLabel: {
      type: String,
      default: "Usuário",
      required: false,
    },
    inlineActivator: {
      type: Boolean,
      default: false,
      required: false,
    },
    showActivator: {
      type: Boolean,
      default: false,
      required: false,
    },
  },
  computed: {
    loading() {
      return Boolean(this.userModal.form.loading);
    },
    userId() {
      return this.userModal.form.id;
    },
    title(){
      return this.userId ? 'Alterar Usuário' : 'Novo Usuário'
    },
    open: {
      get() {
        return this.userModal.form.open;
      },
      set(payload) {
        this.userModal.form.open = payload;
        this.emitInput();
      },
    },
  },
  methods: {
    emitInput() {
      this.$emit("input", this.userModal);
    },
  },
};
</script>