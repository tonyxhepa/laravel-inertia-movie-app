<template>
  <div>
    <Head :title="title" />

    <jet-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-700">
      <!-- nav -->
      <Navbar />
      <!-- Page Content -->
      <main>
        <slot></slot>
      </main>
    </div>
    <Footer />
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";

export default defineComponent({
  props: {
    title: String,
  },

  components: {
    Head,
    Link,
    Navbar,
    Footer,
  },
});
</script>
