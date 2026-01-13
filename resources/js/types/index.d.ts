import { InertiaLinkProps } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';
import { ApiResource, ApiResourceCollection } from './api';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface Todo {
    id: number
    title: string,
    description: string| null,
    owner: User,
    status: TodoStatus,
    created_at: string
    updated_at: string
}

export type TodoStatus =
    | 'todo'
    | 'in_progress'
    | 'done'
    | 'archived'

export type TodoResource = ApiResource<Todo>

export type TodoCollection = ApiResourceCollection<Todo>

export interface TodoStatusOption {
    value: TodoStatus,
    label: string,
}

export type TodoStatusCollection = ApiResourceCollection<TodoStatusOption>
