<template>
  <main class="wrapper" :class="theme">
    <v-app>
      <v-main class="mx-5 my-5">
        <router-view :key="$route.path" />
      </v-main>
    </v-app>
  </main>
</template>

<script>
export default {
  name: "App",
  computed: {
    theme(){
      return 'light'
    }
  }
};
</script>