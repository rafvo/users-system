<template>
  <div>
    <label v-if="showLabel" :class="{ required: required }">{{ label }}</label>

    <!-- modo leitura em texto -->
    <template v-if="textReadonly">
      <label :class="{ required: required }">{{ label }}</label>
      <p>{{ field ? field : "Nenhum registro" }}</p>
    </template>

    <!-- modo leitura no campo -->
    <template v-else-if="fieldReadonly">
      <v-text-field
        :ref="fieldRef"
        :id="uniqueKey"
        :name="uniqueNameKey"
        :value="field"
        :label="label"
        :type="type"
        v-mask="mask"
        readonly
        filled
      >
        <template v-slot:label>
          {{ label }}
          <strong v-if="required" class="text --red">*</strong>
        </template>
      </v-text-field>
    </template>

    <!-- modo edição -->
    <template v-else>
      <validation-provider
        :ref="providerRef"
        :vid="providerVid"
        v-slot="{ errors }"
        :name="label"
        :rules="`${defaultRules}|${rules}${requiredRule}`"
      >
        <v-text-field
          v-model="Field"
          :ref="fieldRef"
          :id="uniqueKey"
          :autofocus="autofocus"
          :append-icon="appendIcon"
          :error-messages="errors"
          :name="uniqueNameKey"
          :placeholder="placeholder"
          :type="type"
          v-mask="mask"
          outlined
          clearable
          @blur="emitBlur"
          @click:append="emitClickAppend"
        >
          <template v-slot:label>
            {{ label }}
            <strong v-if="required" class="text --red">*</strong>
          </template>
        </v-text-field>
      </validation-provider>
    </template>
  </div>
</template>

<script>
export default {
  props: {
    autofocus: {
      type: Boolean,
      default: false,
      required: false,
    },
    appendIcon: {
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
      default: "",
      required: false,
    },
    defaultRef: {
      type: String,
      default: null,
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
      default: "{ Campo }",
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
    textReadonly: {
      type: Boolean,
      default: false,
      required: false,
    },
    type: {
      type: String,
      default: "text",
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
    };
  },
  computed: {
    Field: {
      get() {
        return this.field;
      },
      set(payload) {
        if (!payload) payload = null;
        this.field = payload;
        this.emitInput();
      },
    },
    uniqueKey() {
      return this.id ? `${this.id}` : `${this._uid}`;
    },
    uniqueNameKey() {
      return this.name ? `${this.name}` : `${this._uid}`;
    },
    fieldRef() {
      return this.defaultRef
        ? `${this.defaultRef}`
        : this.uniqueKey.concat("_ref");
    },
    providerRef() {
      return this.uniqueKey.concat("_provider_ref");
    },
    providerVid() {
      return this.vid ? `${this.vid}` : this.uniqueKey.concat("_provider_vid");
    },
    requiredRule() {
      return this.required ? "|".concat("required") : "";
    },
  },
  watch: {
    defaultValue(payload) {
      this.field = payload;
    },
    reset(payload) {
      if (payload) this.Field = null;
    },
  },
  methods: {
    emitBlur() {
      this.$emit("blur", true);
    },
    emitClickAppend() {
      this.$emit("click:append", true);
    },
    emitInput() {
      this.$emit("input", this.field);
    },
  },
  created() {
    this.field = this.defaultValue;
  },
};
</script>

<style scoped>
</style>