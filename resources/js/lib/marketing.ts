import {
    BriefcaseBusiness,
    Building2,
    LayoutGrid,
    Megaphone,
    MonitorSmartphone,
    NotebookText,
    School,
    ShoppingCart,
    Store,
    type LucideIcon,
} from 'lucide-vue-next';

export const serviceIconMap: Record<string, LucideIcon> = {
    store: Store,
    'building-2': Building2,
    'shopping-cart': ShoppingCart,
    megaphone: Megaphone,
    'monitor-smartphone': MonitorSmartphone,
    'notebook-text': NotebookText,
    school: School,
    'briefcase-business': BriefcaseBusiness,
    'layout-grid': LayoutGrid,
};

export const serviceIconOptions = [
    { value: 'store', label: 'UMKM / Toko' },
    { value: 'building-2', label: 'Company Profile' },
    { value: 'shopping-cart', label: 'E-Commerce' },
    { value: 'megaphone', label: 'Landing Page' },
    { value: 'monitor-smartphone', label: 'Aplikasi Web' },
    { value: 'notebook-text', label: 'Katalog Produk' },
    { value: 'school', label: 'Pendidikan' },
    { value: 'briefcase-business', label: 'Portofolio / Agency' },
    { value: 'layout-grid', label: 'Custom / General' },
];

export const pricingAccentMap: Record<
    'bronze' | 'silver' | 'gold' | 'blue',
    { badge: string; card: string }
> = {
    bronze: {
        badge: 'bg-[linear-gradient(180deg,#f2ddca_0%,#d79f68_100%)] text-[#734822]',
        card: 'bg-[#eef5fc]',
    },
    silver: {
        badge: 'bg-[linear-gradient(180deg,#f3f3f3_0%,#bcc0c7_100%)] text-[#5f6268]',
        card: 'bg-[#eef5fc]',
    },
    gold: {
        badge: 'bg-[linear-gradient(180deg,#f5e08d_0%,#d8aa27_100%)] text-[#6e5510]',
        card: 'bg-[#eef5fc]',
    },
    blue: {
        badge: 'bg-[linear-gradient(180deg,#d7ecff_0%,#75b7f0_100%)] text-[#195f98]',
        card: 'bg-[#eef5fc]',
    },
};

export const pricingAccentOptions = [
    { value: 'bronze', label: 'Bronze' },
    { value: 'silver', label: 'Silver' },
    { value: 'gold', label: 'Gold' },
    { value: 'blue', label: 'Blue' },
];
