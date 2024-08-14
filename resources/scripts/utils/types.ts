export interface Category {
  id: string;
  name: string;
}

export interface Todo {
  id: string;
  name: string;
  is_complete: boolean;
  category: Category;
}
