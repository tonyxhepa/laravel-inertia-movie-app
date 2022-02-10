<template>
  <button
    v-bind="$attrs"
    @click="openModal"
    class="
      flex
      items-center
      space-x-2
      border border-slate-100
      bg-slate-100
      dark:border-slate-800 dark:bg-slate-800
      shadow-sm
      px-3
      py-1.5
      hover:border-gray-300
      focus:outline-none focus:border-gray-300
      rounded-lg
    "
  >
    <svg
      class="flex-none text-gray-400 -ml-1"
      width="24"
      height="24"
      fill="none"
      aria-hidden="true"
    >
      <path
        d="m19 19-3.5-3.5"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
      ></path>
      <circle
        cx="11"
        cy="11"
        r="6"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
      ></circle>
    </svg>
    <span class="text-sm hidden text-gray-400 md:block flex-1 text-left"
      >Search...</span
    >
  </button>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog
      class="fixed inset-0 z-50 flex justify-center items-start"
      @close="closeModal"
    >
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <DialogOverlay class="fixed inset-0" />
      </TransitionChild>

      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0 scale-95"
        enter-to="opacity-100 scale-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100 scale-100"
        leave-to="opacity-0 scale-95"
      >
        <div
          class="
            flex flex-col
            overflow-hidden
            z-0
            w-full
            max-w-xl
            bg-white
            dark:bg-slate-900
            rounded-lg
            mx-4
            max-h-[80vh]
            mt-[10vh]
            relative
          "
        >
          <form class="relative flex items-center m-2">
            <div
              class="
                absolute
                inset-y-0
                left-0
                flex
                items-center
                pl-4
                pointer-events-none
              "
            >
              <svg
                class="w-5 h-5 text-gray-700 dark:text-slate-300"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                />
              </svg>
            </div>

            <input
              @input="(e) => search(e.target.value)"
              class="
                w-full
                py-4
                pl-12
                border-b border-gray-100
                dark:text-slate-300 dark:border-gray-700 dark:bg-slate-700
                focus:border-none
                outline-none
                placeholder-gray-400
                rounded-lg
              "
              type="text"
              placeholder="Search..."
            />

            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
              <button
                class="
                  flex
                  items-center
                  p-1.5
                  uppercase
                  font-semibold
                  tracking-wider
                  text-gray-700
                  dark:text-slate-300
                  rounded-md
                  border border-gray-200
                  focus:outline-none focus:border-gray-300
                  text-xs
                "
                type="button"
              >
                x
              </button>
            </div>
          </form>

          <div class="overflow-auto">
            <div
              v-if="isLoading"
              class="border border-blue-300 shadow rounded-md p-4 my-2 mx-2"
            >
              <div class="animate-pulse flex space-x-4">
                <div class="rounded-full bg-slate-200 h-10 w-10"></div>
                <div class="flex-1 space-y-6 py-1">
                  <div class="h-2 bg-slate-200 rounded"></div>
                  <div class="space-y-3">
                    <div class="grid grid-cols-3 gap-4">
                      <div class="h-2 bg-slate-200 rounded col-span-2"></div>
                      <div class="h-2 bg-slate-200 rounded col-span-1"></div>
                    </div>
                    <div class="h-2 bg-slate-200 rounded"></div>
                  </div>
                </div>
              </div>
            </div>
            <ul v-if="results.length > 0 && !isLoading" class="m-2">
              <li
                v-for="item in results"
                :key="item.id"
                class="
                  flex
                  items-center
                  px-4
                  py-2.5
                  relative
                  rounded-lg
                  hover:bg-slate-200
                "
              >
                <Link class="flex space-x-2" :href="item.url"
                  ><div class="text-blue-700 hover:text-blue-500">
                    {{ item.title }}
                  </div>
                  <span>{{ item.type }}</span></Link
                >
              </li>
            </ul>

            <p
              v-if="results.length === 0"
              class="p-10 text-lg text-center text-gray-400"
            >
              No results...
            </p>
          </div>
        </div>
      </TransitionChild>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref } from "vue";
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogOverlay,
  DialogTitle,
} from "@headlessui/vue";

import { Link } from "@inertiajs/inertia-vue3";

import axios from "axios";
import { debounce } from "lodash";

const isOpen = ref(false);
const isLoading = ref(false);
const results = ref([]);

const search = debounce(async (term) => {
  isLoading.value = true;
  let { data } = await axios.get("/api/search", { params: { search: term } });
  results.value = data;
  isLoading.value = false;
}, 250);

function closeModal() {
  isOpen.value = false;
  isLoading.value = false;
}
function openModal() {
  isOpen.value = true;
}
</script>

<style>
</style>