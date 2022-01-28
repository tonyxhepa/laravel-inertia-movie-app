<template>
  <Head title="Welcome" />
  <FrontLayout> Content </FrontLayout>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import FrontLayout from "@/Layouts/FrontLayout";

export default defineComponent({
  components: {
    Head,
    Link,
    FrontLayout,
  },
});
</script>
