<template>
  <v-card
    ><v-card-title v-if="showTitle">
      <slot name="title"></slot>
    </v-card-title>
    
    <v-divider v-if="useTitleDivider"></v-divider>

    <!-- dynamic content -->
    <v-row :class="contentClasses" class="p-10">
      <v-col >
        <slot></slot>
      </v-col>
    </v-row>

    <v-divider v-if="useActionsDivider"></v-divider>

    <v-card-actions v-if="showActions">
      <slot name="actions"></slot>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  props: {
    showTitle: {
      type: Boolean,
      default: true,
      required: false,
    },
    showActions: {
      type: Boolean,
      default: true,
      required: false,
    },
    useTitleDivider: {
      type: Boolean,
      default: false,
      required: false,
    },
    useActionsDivider: {
      type: Boolean,
      default: false,
      required: false,
    },
    contentClasses: {
      type: String,
      default: "",
      required: false,
    },
  },
  data() {
    return {};
  },
};
</script>

<style scoped>
</style>
