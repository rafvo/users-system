<template>
  <div :class="{ 'inline-block': inlineButton }">
    <template v-if="iconButtonType">
      <v-icon :color="iconColor" :small="smallIcon" class="mr-2" @click="open = true">{{ icon }}</v-icon>
    </template>
    <template v-else>
      <v-btn color="primary" outlined @click="open = true">
        <v-icon
          v-if="showButtonIcon"
          small
          :color="iconColor"
          :class="{ 'mr-2': showButtonLabel }"
          >{{ icon }}</v-icon
        >
        <span v-if="showButtonLabel">{{ label }}</span>
      </v-btn>
    </template>
  </div>
</template>

<script>
import Modal from "@/domain/objects/modal";
import { Utils } from "@/util/utils";

export default {
  props: {
    userModal: {
      type: Object,
      default: () => new Modal(),
      required: true,
    },
    userId: {
      type: [String, Number],
      default: null,
      required: false,
    },
    showButtonLabel: {
      type: Boolean,
      default: false,
      required: false,
    },
    showButtonIcon: {
      type: Boolean,
      default: false,
      required: false,
    },
    iconButtonType: {
      type: Boolean,
      default: false,
      required: false,
    },
    insertIcon: {
      type: String,
      default: "",
      required: false,
    },
    iconColor: {
      type: String,
      default: "",
      required: false,
    },
    updateIcon: {
      type: String,
      default: "mdi-pencil",
      required: false,
    },
    insertButtonLabel: {
      type: String,
      default: "Novo",
      required: false,
    },
    updateButtonLabel: {
      type: String,
      default: "Editar",
      required: false,
    },
    inlineButton: {
      type: Boolean,
      default: false,
      required: false,
    },
    smallIcon: {
      type: Boolean,
      default: false,
      required: false,
    }
  },
  computed: {
    loading: {
      get() {
        return this.userModal.form.loading;
      },
      set(payload) {
        this.userModal.form.loading = payload;
      },
    },
    open: {
      get() {
        return this.userModal.form.open;
      },
      set(payload) {
        if (this.isRequest) this.getId();

        this.userModal.form.open = payload;
        this.userModal.form.id = this.userId;

        this.emitInput();
      },
    },
    isEditing() {
      return Boolean(Utils.exist(this.userId));
    },
    isRequest() {
      return Boolean(this.isEditing && !this.open);
    },
    label() {
      return this.isEditing ? this.editingButtonLabel : this.insertButtonLabel;
    },
    icon() {
      return this.isEditing ? this.updateIcon : this.insertIcon;
    },
  },
  methods: {
    getId() {
      this.loading = true;
      this.$store
        .dispatch("users/getId", this.userId)
        .then((data) => {
          this.loading = false;
        })
        .catch(() => {
          this.loading = false;
        });
    },
    emitInput() {
      this.$emit("input", this.userModal);
    },
  },
};
</script>