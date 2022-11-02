<script lang="ts" setup>
  import type { ICategory } from '@/scripts/utils/types';
  import Icon from '@components/Icon.vue';
  import { Inertia } from '@inertiajs/inertia';

  defineProps<{
    categories: ICategory[];
  }>();

  const remove = (category: ICategory) => {
    Inertia.delete(`/categories/${category.uuid}`);
  };
</script>

<template>
  <ul v-if="categories.length">
    <li
      v-for="category in categories"
      :key="category.uuid"
      class="flex items-center justify-start px-2 py-1 -mx-2 space-x-2 hover:bg-gray-lighter"
    >
      <button type="button" class="w-4 text-red shrink-0" @click="remove(category)">
        <Icon name="close" />
      </button>
      <span class="text-lg font-medium truncate shrink">{{ category.name }}</span>
    </li>
  </ul>
</template>
