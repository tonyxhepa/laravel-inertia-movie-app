<template>
  <div
    class="w-full text-gray-700 bg-white dark:text-gray-200 dark:bg-gray-800"
  >
    <div
      class="
        flex flex-col
        max-w-screen-xl
        px-4
        mx-auto
        md:items-center md:justify-between md:flex-row md:px-6
        lg:px-8
      "
    >
      <div class="p-4 flex flex-row items-center justify-between space-x-2">
        <a
          href="/"
          class="
            text-lg
            font-semibold
            tracking-widest
            text-gray-900
            uppercase
            rounded-lg
            dark:text-white
            focus:outline-none focus:shadow-outline
          "
          >Movie App</a
        >
        <SearchModal class="w-40 md:w-72" />
        <button
          class="md:hidden rounded-lg focus:outline-none focus:shadow-outline"
          @click="openMobileMenu = !openMobileMenu"
        >
          <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
            <path
              v-show="!openMobileMenu"
              fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
              clip-rule="evenodd"
            ></path>
            <path
              v-show="openMobileMenu"
              fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </button>
      </div>
      <nav
        :class="{ flex: openMobileMenu, hidden: !openMobileMenu }"
        class="
          flex-col flex-grow
          pb-4
          md:pb-0 md:flex md:justify-end md:flex-row
        "
      >
        <Link
          class="
            bg-transparent
            px-4
            py-2
            mt-2
            text-sm
            font-semibold
            rounded-lg
            dark:hover:bg-gray-600
            dark:focus:bg-gray-600
            dark:focus:text-white
            dark:hover:text-white
            dark:text-gray-200
            md:mt-0 md:ml-4
            hover:text-gray-900
            focus:text-gray-900
            hover:bg-gray-200
            focus:bg-gray-200 focus:outline-none focus:shadow-outline
          "
          href="/movies"
          >Movies</Link
        >
        <Link
          class="
            bg-transparent
            px-4
            py-2
            mt-2
            text-sm
            font-semibold
            rounded-lg
            dark:hover:bg-gray-600
            dark:focus:bg-gray-600
            dark:focus:text-white
            dark:hover:text-white
            dark:text-gray-200
            md:mt-0 md:ml-4
            hover:text-gray-900
            focus:text-gray-900
            hover:bg-gray-200
            focus:bg-gray-200 focus:outline-none focus:shadow-outline
          "
          href="/tv-shows"
          >Tv Shows</Link
        >
        <Link
          class="
            bg-transparent
            px-4
            py-2
            mt-2
            text-sm
            font-semibold
            rounded-lg
            dark:hover:bg-gray-600
            dark:focus:bg-gray-600
            dark:focus:text-white
            dark:hover:text-white
            dark:text-gray-200
            md:mt-0 md:ml-4
            hover:text-gray-900
            focus:text-gray-900
            hover:bg-gray-200
            focus:bg-gray-200 focus:outline-none focus:shadow-outline
          "
          href="/casts"
          >Casts</Link
        >
        <Dropdown />
      </nav>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import Dropdown from "./Dropdown.vue";
import SearchModal from "./SearchModal.vue";

const open = ref(false);
const openMobileMenu = ref(false);
</script>

<style>
</style>