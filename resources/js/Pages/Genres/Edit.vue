<template>
  <admin-layout title="Dashboard">
    <template #header> Genre Edit </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.genres.index')"
              class="
                bg-green-500
                hover:bg-green-700
                text-white
                px-4
                py-2
                rounded-lg
              "
            >
              Genre Index
            </Link>
          </div>

          <div
            class="
              w-full
              mb-8
              sm:max-w-md
              p-6
              overflow-hidden
              bg-white
              rounded-lg
              shadow-lg
            "
          >
            <form @submit.prevent="submitGenre">
              <div>
                <jet-label for="title" value="Title" />
                <jet-input
                  id="title"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.title"
                  autofocus
                  autocomplete="title"
                />
                <div class="text-sm text-red-400" v-if="form.errors.title">
                  {{ form.errors.title }}
                </div>
              </div>

              <div class="flex items-center justify-end mt-4">
                <jet-button
                  class="ml-4"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Update
                </jet-button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </admin-layout>
</template>

<script setup>
import AdminLayout from "../../Layouts/AdminLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, watch, defineProps } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
const props = defineProps({
  genre: Object,
});

const form = useForm({
  title: props.genre.title,
});

function submitGenre() {
  form.put("/admin/genres/" + props.genre.id);
}
</script>