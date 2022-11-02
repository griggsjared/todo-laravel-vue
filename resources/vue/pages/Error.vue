<script lang="ts" setup>
  import { computed } from 'vue';

  type TError = {
    title: string;
  };

  const errorTypes: {
    [key: number]: TError;
  } = {
    503: { title: 'Service Unavailable' },
    500: { title: "Sorry, we've encountered an error." },
    404: { title: 'Page Not Found' },
    401: { title: 'Unauthorized' },
    403: { title: 'Unauthorized' },
  };

  const props = defineProps<{
    status: number;
  }>();

  const error = computed<TError>(function () {
    return typeof errorTypes[props.status] !== 'undefined'
      ? errorTypes[props.status]
      : { title: `${props.status}: Oops`, links: true };
  });
</script>

<template>
  <div class="flex flex-col min-h-full pt-16 pb-12 bg-blue-dark">
    <main class="flex flex-col justify-center flex-grow w-full px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="mt-2 text-4xl font-extrabold tracking-wide text-white text-gray-900 sm:text-5xl">
          {{ error.title }}
        </h1>
      </div>
    </main>
  </div>
</template>
