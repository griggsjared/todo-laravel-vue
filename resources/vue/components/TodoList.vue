<script lang="ts" setup>
  import type { Todo } from '@/scripts/utils/types';
  import Icon from '@components/Icon.vue';
  import { router } from '@inertiajs/vue3';

  const props = defineProps<{
    todos: Todo[];
  }>();

  const toggleComplete = (todo: Todo) => {
    todo.is_complete = !todo.is_complete;

    router.put(
      `/todos/${todo.id}/toggle-complete`,
      {
        is_complete: todo.is_complete,
      },
      {
        preserveScroll: true,
      }
    );
  };

  const remove = (todo: Todo) => {
    const index: number = props.todos.findIndex((t: Todo) => t.id === todo.id);
    if (index > -1) {
      props.todos.splice(index, 1);
    }
    router.delete(`/todos/${todo.id}`, { preserveScroll: true });
  };
</script>

<template>
  <ul v-if="todos.length">
    <li
      v-for="todo in todos"
      :key="todo.id"
      class="flex items-start justify-between px-2 py-1 -mx-2 space-x-2 hover:bg-gray-lighter"
    >
      <span class="flex items-start justify-start space-x-2 shrink">
        <button type="button" class="text-gray-base w-5 shrink-0 mt-0.5" @click="toggleComplete(todo)">
          <Icon :name="todo.is_complete ? 'checkbox-checked' : 'checkbox-unchecked'" />
        </button>
        <div
          class="text-lg font-medium"
          :class="{
            'line-through': todo.is_complete,
          }"
        >
          {{ todo.name }}
        </div>
      </span>
      <button type="button" class="w-4 text-red shrink-0" @click="remove(todo)">
        <Icon name="close" />
      </button>
    </li>
  </ul>
  <div v-else>No TODO items found for the current filter.</div>
</template>
