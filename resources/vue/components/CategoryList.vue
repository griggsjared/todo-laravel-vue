<script lang="ts" setup>
  import type { Category } from '@/scripts/utils/types';
  import Icon from '@components/Icon.vue';
  import { router } from '@inertiajs/vue3';

  const props = defineProps<{
    categories: Category[];
  }>();

  const remove = (category: Category) => {
    const index: number = props.categories.findIndex((c: Category) => c.id === category.id);

    if (index > -1) {
      props.categories.splice(index, 1);
    }

    router.delete(`/categories/${category.id}`, { preserveScroll: true });
  };
</script>

<template>
  <ul v-if="categories.length">
    <li
      v-for="category in categories"
      :key="category.id"
      class="flex items-center justify-start px-2 py-1 -mx-2 space-x-2 hover:bg-gray-lighter"
    >
      <button type="button" class="w-4 text-red shrink-0" @click="remove(category)">
        <Icon name="close" />
      </button>
      <span class="text-lg font-medium truncate shrink">{{ category.name }}</span>
    </li>
  </ul>
</template>
