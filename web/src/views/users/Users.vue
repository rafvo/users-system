<template>
  <section>
    <v-row>
      <v-col cols="12" sm="12">
        <user-list-a
          show-insert-button
          is-modal-form
        />
      </v-col>
    </v-row>
  </section>
</template>

<script>
import UserListA from "@/components/list/UserListA.vue";

export default {
  components: {
    UserListA,
  },
};
</script>

<style scoped>
</style>
