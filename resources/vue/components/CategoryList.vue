<script lang="ts" setup>
  import type { ICategory } from '@/scripts/utils/types';
  import Icon from '@components/Icon.vue';
  import { Inertia } from '@inertiajs/inertia';

  const props = defineProps<{
    categories: ICategory[];
  }>();

  const remove = (category: ICategory) => {
    const index: number = props.categories.findIndex((c: ICategory) => c.uuid === category.uuid);

    if (index > -1) {
      props.categories.splice(index, 1);
    }

    Inertia.delete(`/categories/${category.uuid}`, { preserveScroll: true });
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
