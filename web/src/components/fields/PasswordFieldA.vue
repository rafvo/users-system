<template>
  <div class="row">
    <div :class="passwordGridClass">
      <text-field-a
        :append-icon="appendIcon"
        :default-value="defaultValue"
        :default-rules="defaultRules"
        :field-readonly="fieldReadonly"
         :autofocus="autofocus"
        :id="id"
        :label="label"
        :mask="mask"
        :name="name"
        :placeholder="placeholder"
        :required="required"
        :rules="`${rules}|${confirmedRule}`"
        :reset="reset"
        :show-label="showLabel"
        :type="type"
        :vid="passwordVid"
        @input="emitInput"
        @click:append="showPassword = !showPassword"
      />
    </div>

    <div :class="confirmationGridClass">
      <slot name="confirm">
        <template v-if="withConfirmation">
          <text-field-a
            :append-icon="appendIcon"
            :default-rules="defaultRules"
            :field-readonly="fieldReadonly"
            :label="confirmationLabel"
            :mask="mask"
            :placeholder="confirmationPlaceholder"
            :required="required"
            :rules="`${rules}`"
            :reset="reset"
            :show-label="showLabel"
            :type="type"
            :vid="confirmationVid"
            @click:append="showPassword = !showPassword"
          />
        </template>
      </slot>
    </div>
  </div>
</template>

<script>
import TextFieldA from "./TextFieldA.vue";

export default {
  components: { TextFieldA },
  props: {
    autofocus: {
      type: Boolean,
      default: false,
      required: false,
    },
    confirmationLabel: {
      type: String,
      default: "Confirmar Senha",
      required: false,
    },
    confirmationPlaceholder: {
      type: String,
      default: "",
      required: false,
    },
    defaultValue: {
      type: [Number, String],
      default: "",
      required: false,
    },
    defaultRules: {
      type: String,
      default: "min:6",
      required: false,
    },
    defaultShowPassword: {
      type: Boolean,
      default: false,
      required: false,
    },
    fieldReadonly: {
      type: Boolean,
      default: false,
      required: false,
    },
    grid: {
      type: [String, Number],
      default: 12,
      required: false,
    },
    id: {
      type: String,
      default: null,
      required: false,
    },
    iconShowPassword: {
      type: String,
      default: "mdi-eye",
      required: false,
    },
    iconHidePassword: {
      type: String,
      default: "mdi-eye-off",
      required: false,
    },
    label: {
      type: String,
      default: "Senha",
      required: false,
    },
    mask: {
      type: String,
      default: "",
      required: false,
    },
    name: {
      type: String,
      default: null,
      required: false,
    },
    placeholder: {
      type: String,
      default: "",
      required: false,
    },
    required: {
      type: Boolean,
      default: false,
      required: false,
    },
    rules: {
      type: String,
      default: "",
      required: false,
    },
    reset: {
      type: Boolean,
      default: false,
      required: false,
    },
    showLabel: {
      type: Boolean,
      default: false,
      required: false,
    },
    withConfirmation: {
      type: Boolean,
      default: false,
      required: false,
    },
    inlineField: {
      type: Boolean,
      default: false,
      required: false,
    },
    vid: {
      type: String,
      default: null,
      required: false,
    },
  },
  data() {
    return {
      showPassword: false,
    };
  },
  computed: {
    type() {
      return this.showPassword ? "text" : "password";
    },
    appendIcon() {
      return this.showPassword ? this.iconHidePassword : this.iconShowPassword;
    },
    uniqueKey() {
      return `${this._uid}`;
    },
    passwordVid() {
      return this.vid ? `${this.vid}` : this.uniqueKey.concat("_vid");
    },
    confirmationVid() {
      return this.uniqueKey.concat("_confirmation_vid");
    },
    confirmedRule() {
      return `confirmed:${this.confirmationVid}`;
    },
    maxGrid() {
      return 12;
    },
    passwordGrid() {
      return this.grid <= this.maxGrid ? this.grid : this.maxGrid;
    },
    confirmationGrid() {
      return this.passwordGrid < this.maxGrid
        ? this.maxGrid - this.passwordGrid
        : this.maxGrid;
    },
    passwordGridClass() {
      return `col-md-${this.passwordGrid}`;
    },
    confirmationGridClass() {
      return `col-md-${this.confirmationGrid}`;
    },
  },
  watch: {
    defaultShowPassword() {
      this.showPassword = this.defaultShowPassword;
    },
    fieldReadonly(payload){
      if(payload) this.showPassword = false
    } 
  },
  methods: {
    emitInput(payload) {
      this.$emit("input", payload);
    },
  },
  created() {
    this.showPassword = this.defaultShowPassword;
  },
};
</script>

<style scoped>
</style>