<template>
  <Head :title="`${season.name} Season`" />
  <FrontLayout>
    <main v-if="season" class="my-2">
      <section class="bg-gradient-to-r from-indigo-700 to-transparent">
        <div class="max-w-6xl mx-auto m-4 p-2">
          <div class="flex">
            <div class="w-3/12">
              <div class="w-full">
                <img
                  class="w-full h-full rounded"
                  :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${season.poster_path}`"
                />
              </div>
            </div>
            <div class="w-8/12">
              <div class="m-4 p-6">
                <h1 class="flex text-white font-bold text-4xl">
                  {{ season.name }}
                </h1>
                <div class="flex p-3 text-white space-x-4">
                  <span>Season Nr: {{ season.season_number }}</span>
                  <span
                    >Tv Show: {{ tvShow.name }} -
                    {{ tvShow.created_year }}</span
                  >
                </div>
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
              Episodes
            </h1>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
              <MovieCard v-for="episode in episodes" :key="episode.id">
                <template #image>
                  <Link :href="`/episodes/${episode.slug}`">
                    <img
                      class=""
                      :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${season.poster_path}`"
                    />
                  </Link>
                </template>
                <Link :href="`/episodes/${episode.slug}`">
                  <span class="text-slate-600 dark:text-white">{{
                    episode.name
                  }}</span>
                </Link>
              </MovieCard>
            </div>
          </div>
          <div class="w-4/12">
            <h1
              class="flex text-slate-600 dark:text-white font-bold text-xl mb-4"
            >
              Latest movies
            </h1>
            <div class="grid grid-cols-3 gap-2" v-if="latests.length">
              <Link
                v-for="lm in latests"
                :key="lm.id"
                :href="`/movies/${lm.slug}`"
              >
                <img
                  class="w-full h-full rounded-lg"
                  :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${lm.poster_path}`"
                />
              </Link>
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
  tvShow: Object,
  latests: Array,
  episodes: Array,
  season: Object,
});
</script>

<style>
</style>