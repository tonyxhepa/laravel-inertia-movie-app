<template>
  <Head :title="`${cast.name} Actor`" />
  <FrontLayout>
    <main v-if="cast" class="my-2">
      <section class="bg-gradient-to-r from-indigo-700 to-transparent">
        <div class="max-w-6xl mx-auto m-4 p-2">
          <div class="flex">
            <div class="w-3/12">
              <div class="w-full">
                <img
                  class="w-full h-full rounded"
                  :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${cast.poster_path}`"
                />
              </div>
            </div>
            <div class="w-8/12">
              <div class="m-4 p-6">
                <h1 class="flex text-blue-300 font-bold text-4xl">
                  {{ cast.name }}
                </h1>
                <div class="text-white">Movies: {{ movies.length }}</div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section
        class="max-w-6xl mx-auto bg-gray-200 dark:bg-gray-900 p-2 rounded"
      >
        <div class="flex justify-between">
          <div class="w-7/12">
            <h1 class="flex text-slate-600 dark:text-white font-bold text-xl">
              {{ cast.name }} Movies
            </h1>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
              <MovieCard v-for="movie in movies" :key="movie.id">
                <template #image>
                  <Link :href="`/movies/${movie.slug}`">
                    <img
                      class=""
                      :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${movie.poster_path}`"
                    />
                  </Link>
                </template>
                <Link :href="`/movies/${movie.slug}`">
                  <span class="text-slate-600 dark:text-white">{{
                    movie.title
                  }}</span>
                </Link>
              </MovieCard>
            </div>
          </div>
        </div>
      </section>
    </main>
  </FrontLayout>
</template>

<script setup>
import { ref } from "vue";
import FrontLayout from "@/Layouts/FrontLayout";
import MovieCard from "@/Components/MovieCard";
import { Link, Head } from "@inertiajs/inertia-vue3";

defineProps({
  cast: Object,
  movies: Array,
});
</script>

<style>
</style>