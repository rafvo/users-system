<template>
  <div :class="{ 'inline-block': inlineButton }">
    <v-icon @click="show = true" :color="buttonColor">
      {{ buttonIcon }}
    </v-icon>
    <v-dialog v-model="Show" :max-width="maxWidth">
      <v-card>
        <v-card-title>
          <slot name="message">
            <p>{{ message }}</p>
          </slot>
        </v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red darken-1" text @click="Cancel = true">{{
            cancelAction
          }}</v-btn>
          <v-btn color="blue darken-1" text @click="Confirm = true">{{
            confirmAction
          }}</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>

export default {
  props: {
    open: {
      type: [Number, Boolean],
      default: false,
      required: false,
    },
    message: {
      type: String,
      default: "Tem certeza que deseja realizar esta ação?",
      required: false,
    },
    confirmAction: {
      type: String,
      default: "Sim",
      required: false,
    },
    cancelAction: {
      type: String,
      default: "Cancelar",
      required: false,
    },
    maxWidth: {
      type: String,
      default: "500px",
      required: false,
    },
    buttonColor: {
      type: String,
      default: "primary",
      required: false,
    },
    buttonIcon: {
      type: String,
      default: "",
      required: false,
    },
    inlineButton: {
      type: [Number, Boolean],
      default: false,
      required: false,
    },
  },
  data() {
    return {
      show: false,
      cancel: false,
      confirm: false,
    };
  },
  computed: {
    Show: {
      get() {
        return this.show;
      },
      set(payload) {
        this.show = payload;
        this.emitInput();
      },
    },
    Cancel: {
      get() {
        return this.cancel;
      },
      set(payload) {
        this.cancel = payload;

        this.Show = false;
        this.confirm = false;

        this.emitCancel();
      },
    },
    Confirm: {
      get() {
        return this.confirm;
      },
      set(payload) {
        this.confirm = payload;

        this.Show = false;
        this.cancel = false;
        
        this.emitConfirm();
      },
    },
  },
  watch: {
    open() {
      this.show = this.open;
    },
  },
  methods: {
    emitCancel() {
      this.$emit("cancel", this.cancel);
    },
    emitConfirm() {
      this.$emit("confirm", this.confirm);
    },
    emitInput() {
      this.$emit("input", this.show);
    },
  },
  created() {
    this.show = this.open;
  },
};
</script>

<style scoped>
.v-card__title{
  font-weight: normal!important;
}
</style>