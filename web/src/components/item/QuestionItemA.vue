<template>
  <div>
    <v-row class="center px-5 mt-2">
      <v-col cols="12" sm="12">
        <p class="text-justify mb-1">
          {{ question.description }}
        </p>
      </v-col>
    </v-row>
    <v-row v-if="existAlternatives">
      <v-col cols="12" sm="12">
        <alternatives-list-a
          :question-id="question.id"
          :alternatives="question.alternatives"
        />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import { Utils } from "@/util/utils";
import AlternativesListA from "@/components/list/AlternativesListA.vue";

export default {
  components: {
    AlternativesListA,
  },
  props: {
    question: {
      type: Object,
      default: () => {},
      required: true,
    },
  },
  computed: {
    existQuestion() {
      return Boolean(Utils.exist(this.question));
    },
    existAlternatives() {
      return Boolean(
        this.existQuestion && Utils.exist(this.question.alternatives)
      );
    },
  },
};
</script>

<style>
</style>
