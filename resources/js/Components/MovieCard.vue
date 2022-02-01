<template>
  <div class="group bg-gray-300 dark:bg-gray-800 shadow-lg rounded p-1">
    <div class="relative">
      <slot name="image"></slot>
    </div>
    <div class="p-2">
      <slot />
    </div>
  </div>
</template>