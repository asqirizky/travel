export interface TourPackage {
    id: number;
    title: string;
    slug: string;
    location: string;
    short_description: string;
    price: number;
    duration_days: number;
    duration_nights: number;
    max_capacity: number;
    thumbnail: string | null;
    is_active: boolean;
    created_at: string;
}

export interface Package {
    id: number;
    name_package: string;
    slug: string;
    location: string;
    short_description: string;
    duration_days: number;
    duration_nights: number;
    thumbnail: string | null;
    is_active: boolean;
    created_at: string;
}

export interface DestinationSection {
    id: number;
    destination_id: number;
    title: string;
    description: string | null;
    image: string | null;
    sort_order: number;
}

export interface Destination {
    id: number;
    name: string;
    slug: string;
    location: string | null;
    short_description: string | null;
    description: string | null;
    image: string | null;
    is_active: boolean;
    sections?: DestinationSection[];
    sections_count?: number;
    created_at: string;
}
