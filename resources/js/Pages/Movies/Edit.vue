<template>
  <admin-layout title="Dashboard">
    <template #header> Movie Edit </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.movies.index')"
              class="
                bg-green-500
                hover:bg-green-700
                text-white
                px-4
                py-2
                rounded-lg
              "
            >
              Movie Index
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
            <form @submit.prevent="submitMovie">
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

              <div>
                <jet-label for="runtime" value="Runtime" />
                <jet-input
                  id="runtime"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.runtime"
                  autofocus
                  autocomplete="runtime"
                />
                <div class="text-sm text-red-400" v-if="form.errors.runtime">
                  {{ form.errors.runtime }}
                </div>
              </div>
              <div>
                <jet-label for="lang" value="Language" />
                <jet-input
                  id="lang"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.lang"
                  autofocus
                  autocomplete="lang"
                />
                <div class="text-sm text-red-400" v-if="form.errors.lang">
                  {{ form.errors.lang }}
                </div>
              </div>
              <div>
                <jet-label for="video_format" value="Format" />
                <jet-input
                  id="video_format"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.video_format"
                  autofocus
                  autocomplete="video_format"
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.video_format"
                >
                  {{ form.errors.video_format }}
                </div>
              </div>
              <div>
                <jet-label for="rating" value="Rating" />
                <jet-input
                  id="rating"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.rating"
                  autofocus
                  autocomplete="rating"
                />
                <div class="text-sm text-red-400" v-if="form.errors.rating">
                  {{ form.errors.rating }}
                </div>
              </div>

              <div class="mt-4">
                <jet-label for="poster_path" value="Poster" />
                <jet-input
                  id="poster_path"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.poster_path"
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.poster_path"
                >
                  {{ form.errors.poster_path }}
                </div>
              </div>

              <div class="mt-4">
                <jet-label for="backdrop_path" value="Backdrop" />
                <jet-input
                  id="backdrop_path"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.backdrop_path"
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.backdrop_path"
                >
                  {{ form.errors.backdrop_path }}
                </div>
              </div>
              <div class="mt-4">
                <jet-label for="overview" value="Overview" />
                <jet-input
                  id="overview"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.overview"
                />
                <div class="text-sm text-red-400" v-if="form.errors.overview">
                  {{ form.errors.overview }}
                </div>
              </div>
              <div class="mt-4">
                <label class="flex items-center">
                  <jet-checkbox
                    name="is_public"
                    v-model:checked="form.is_public"
                  />
                  <span class="ml-2 text-sm text-gray-600">Public</span>
                </label>
                <div class="text-sm text-red-400" v-if="form.errors.is_public">
                  {{ form.errors.is_public }}
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
import { ref, watch } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";

const props = defineProps({
  movie: Object,
});

const form = useForm({
  title: props.movie.title,
  poster_path: props.movie.poster_path,
  video_format: props.movie.video_format,
  runtime: props.movie.runtime,
  rating: props.movie.rating,
  backdrop_path: props.movie.backdrop_path,
  overview: props.movie.overview,
  is_public: props.movie.is_public ? true : false,
  lang: props.movie.lang,
});

function submitMovie() {
  form.put(`/admin/movies/${props.movie.id}`);
}
</script>

<style>
</style>