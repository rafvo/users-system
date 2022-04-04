<template>
  <text-field-a
    v-model="Field"
    :default-value="value"
    :default-rules="defaultRules"
    :autofocus="autofocus"
    :field-readonly="fieldReadonly"
    :id="id"
    :label="label"
    :mask="dynamicMask"
    :name="name"
    :placeholder="placeholder"
    :required="required"
    :rules="`${rules}|${minMaxRule}`"
    :reset="reset"
    :show-label="showLabel"
    :text-readonly="textReadonly"
    :vid="vid"
  />
</template>

<script>
import Vue from "vue";
import TextFieldA from "./TextFieldA.vue";

export default {
  components: {
    TextFieldA,
  },
  props: {
    autofocus: {
      type: Boolean,
      default: false,
      required: false,
    },
    defaultValue: {
      type: [Number, String],
      default: "",
      required: false,
    },
    defaultRules: {
      type: String,
      default: "",
      required: false,
    },
    fieldReadonly: {
      type: Boolean,
      default: false,
      required: false,
    },
    id: {
      type: String,
      default: null,
      required: false,
    },
    label: {
      type: String,
      default: "Telefone",
      required: false,
    },
    name: {
      type: String,
      default: null,
      required: false,
    },
    noMask: {
      type: Boolean,
      default: false,
      required: false,
    },
    noMaskResult: {
      type: Boolean,
      default: false,
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
    textReadonly: {
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
      field: null,
      unmaskField: null,
      dynamicMask: "",
    };
  },
  computed: {
    Field: {
      get() {
        return this.field;
      },
      set(payload) {
        this.dynamicMask = this.defineMask(payload);

        this.field = payload;

        if (this.noMaskResult) {
          this.unmaskField = payload
            ? payload.replace(/[\(\)\.\s-]+/g, "")
            : null;

          this.emitInput(this.unmaskField);
        } else {
          this.emitInput(this.field);
        }
      },
    },
    value() {
      return this.noMask ? this.unmaskField : this.field;
    },
    phoneMask() {
      return "(##) ####-####";
    },
    celphoneMask() {
      return "(##) #####-####";
    },
    phoneMaskLength() {
      return this.phoneMask.length;
    },
    celphoneMaskLength() {
      return this.celphoneMask.length;
    },
    cleanPhoneMask() {
      return this.phoneMask.replace(/[\(\)\.\s-]+/g, "");
    },
    cleanCelphoneMask() {
      return this.celphoneMask.replace(/[\(\)\.\s-]+/g, "");
    },
    cleanPhoneMaskLength() {
      return this.cleanPhoneMask.length;
    },
    cleanCelphoneMaskLength() {
      return this.cleanCelphoneMask.length;
    },
    minMaxRule() {
      return `min:${this.minLength}|max:${this.maxLength}`;
    },
    minLength() {
      return this.phoneMaskLength < this.celphoneMaskLength
        ? this.phoneMaskLength
        : this.celphoneMaskLength;
    },
    maxLength() {
      return this.phoneMaskLength > this.celphoneMaskLength
        ? this.phoneMaskLength
        : this.celphoneMaskLength;
    },
  },
  watch: {
    defaultValue() {
      this.setDefaultValue();
    },
  },
  methods: {
    setDefaultValue() {
      const cleanDefaultValue = this.defaultValue
        ? this.defaultValue.replace(/[^0-9]/g, "")
        : null;

      if (this.noMask) this.unmaskField = cleanDefaultValue;

      this.field = Vue.filter("phoneCelphone")(cleanDefaultValue);

      this.dynamicMask = this.defineMask(this.field);
    },
    defineMask(payload) {
      if (this.noMask) return "";

      var mask = this.dynamicMask;

      if (!payload) return mask;

      payload = payload.replace(/[^0-9]/g, "");

      if (payload.length <= this.cleanPhoneMaskLength) mask = this.phoneMask;
      else if (payload.length <= this.cleanCelphoneMaskLength)
        mask = this.celphoneMask;

      return mask;
    },
    emitInput(payload) {
      this.$emit("input", payload);
    },
  },
  created() {
    this.setDefaultValue();
  },
};
</script>

<style>
</style>