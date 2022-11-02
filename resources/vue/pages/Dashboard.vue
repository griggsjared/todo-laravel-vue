<script lang="ts" setup>
  import type { ICategory, ITodo } from '@/scripts/utils/types';
  import CategoryAdd from '@components/CategoryAdd.vue';
  import CategoryList from '@components/CategoryList.vue';
  import TodoAdd from '@components/TodoAdd.vue';
  import TodoList from '@components/TodoList.vue';
  import { Link } from '@inertiajs/inertia-vue3';

  const props = defineProps<{
    categories: ICategory[];
    category?: ICategory | null;
    todos: ITodo[];
  }>();

  const isCurrentCategory = (category: ICategory): boolean => {
    return category.uuid === props.category?.uuid;
  };

  const isAll = (): boolean => !props.category;
</script>

<template>
  <div class="w-full max-w-4xl p-6 mx-auto bg-white divide-y-2 rounded-lg sm:p-12 divide-gray-base">
    <div class="pb-6">
      <h1 class="mb-2 text-2xl font-medium uppercase">TODO List</h1>
      <div v-if="categories.length" class="flex flex-wrap items-start justify-start py-2">
        <span class="mr-1 shrink-0">Show Category:</span>
        <ul class="flex flex-wrap items-center justify-start divide-x divide-gray-dark">
          <li
            v-for="category in categories"
            :key="category.uuid"
            class="px-2 font-medium first:pl-0"
            :class="{
              'text-blue-light': !isCurrentCategory(category),
              'text-black': isCurrentCategory(category),
            }"
          >
            <Link :href="`/?category=${category.uuid}`">{{ category.name }}</Link>
          </li>
          <li
            class="pl-2 font-medium"
            :class="{
              'text-blue-light': !isAll,
              'text-black': isAll,
            }"
          >
            <Link href="/">All</Link>
          </li>
        </ul>
      </div>
      <div class="pb-2 mb-4 border-b border-b-gray-lighter">
        <TodoList :todos="todos" />
      </div>
      <TodoAdd :categories="categories" />
    </div>
    <div class="pt-6">
      <h2 class="mb-4 text-2xl font-medium uppercase">Categories</h2>
      <div class="py-2 mb-1">
        <CategoryAdd />
      </div>
      <CategoryList :categories="categories" />
    </div>
  </div>
</template>
