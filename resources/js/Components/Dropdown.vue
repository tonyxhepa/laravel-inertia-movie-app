<template>
  <Menu as="div" class="relative inline-block text-left" v-slot="{ open }">
    <div>
      <MenuButton
        class="
          bg-transparent
          dark:bg-transparent
          flex flex-row
          items-center
          w-full
          px-4
          py-2
          mt-2
          text-sm
          font-semibold
          text-left
          rounded-lg
          dark:focus:text-white
          dark:hover:text-white
          dark:focus:bg-gray-600
          dark:hover:bg-gray-600
          md:w-auto md:inline md:mt-0 md:ml-4
          hover:text-gray-900
          focus:text-gray-900
          hover:bg-gray-200
          focus:bg-gray-200 focus:outline-none focus:shadow-outline
        "
      >
        Genres
        <svg
          fill="currentColor"
          viewBox="0 0 20 20"
          :class="{ 'rotate-180': open, 'rotate-0': !open }"
          class="
            inline
            w-4
            h-4
            mt-1
            ml-1
            transition-transform
            duration-200
            transform
            md:-mt-1
          "
        >
          <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path>
        </svg>
      </MenuButton>
    </div>

    <transition
      enter-active-class="transition duration-100 ease-out"
      enter-from-class="transform scale-95 opacity-0"
      enter-to-class="transform scale-100 opacity-100"
      leave-active-class="transition duration-75 ease-in"
      leave-from-class="transform scale-100 opacity-100"
      leave-to-class="transform scale-95 opacity-0"
    >
      <MenuItems
        class="
          absolute
          z-30
          right-0
          w-full
          md:w-96
          mt-2
          origin-top-right
          bg-white
          divide-y divide-gray-100
          rounded-md
          shadow-lg
          ring-1 ring-black ring-opacity-5
          focus:outline-none
        "
      >
        <div
          class="
            px-2
            py-2
            bg-white
            rounded-md
            shadow
            dark:bg-gray-800
            flex flex-wrap
          "
          v-show="open"
        >
          <MenuItem
            as="template"
            v-for="genre in $page.props.genres"
            :key="genre.id"
          >
            <Link
              class="
                text-sm
                p-2
                m-2
                font-semibold
                bg-transparent
                rounded-lg
                dark:bg-transparent
                dark:hover:bg-gray-600
                dark:focus:bg-gray-600
                dark:focus:text-white
                dark:hover:text-white
                dark:text-gray-200
                md:mt-0
                hover:text-gray-900
                focus:text-gray-900
                hover:bg-gray-200
                focus:bg-gray-200 focus:outline-none focus:shadow-outline
              "
              :href="`/genres/${genre.slug}`"
              >{{ genre.title }}</Link
            >
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>

<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { Link } from "@inertiajs/inertia-vue3";
</script>
