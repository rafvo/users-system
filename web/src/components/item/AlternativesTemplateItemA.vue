<template>
  <div>
    <v-row>
      <v-col>
        <v-text-field
          label="Índice"
          placeholder="Índice"
          readonly
          :value="item.index"
          filled
        ></v-text-field>
      </v-col>
      <v-col cols="11">
        <alternatives-template-description-textarea-a
          :description="item.description"
          field-readonly
        />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import AlternativesTemplateDescriptionTextareaA from "@/components/textarea/AlternativesTemplateDescriptionTextareaA.vue";

export default {
  components: {
    AlternativesTemplateDescriptionTextareaA,
  },
  props: {
    item: {
      type: Object,
      default: () => {},
      required: false,
    },
  },
};
</script>

<style>
</style>