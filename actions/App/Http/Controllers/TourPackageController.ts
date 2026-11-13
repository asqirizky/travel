import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/packages/{slug}'
*/
const show8862c2e54ef5beb858de0ed053b1502a = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show8862c2e54ef5beb858de0ed053b1502a.url(args, options),
    method: 'get',
})

show8862c2e54ef5beb858de0ed053b1502a.definition = {
    methods: ["get","head"],
    url: '/packages/{slug}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/packages/{slug}'
*/
show8862c2e54ef5beb858de0ed053b1502a.url = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { slug: args }
    }

    if (Array.isArray(args)) {
        args = {
            slug: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        slug: args.slug,
    }

    return show8862c2e54ef5beb858de0ed053b1502a.definition.url
            .replace('{slug}', parsedArgs.slug.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/packages/{slug}'
*/
show8862c2e54ef5beb858de0ed053b1502a.get = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show8862c2e54ef5beb858de0ed053b1502a.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/packages/{slug}'
*/
show8862c2e54ef5beb858de0ed053b1502a.head = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show8862c2e54ef5beb858de0ed053b1502a.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/packages/{slug}'
*/
const show8862c2e54ef5beb858de0ed053b1502aForm = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show8862c2e54ef5beb858de0ed053b1502a.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/packages/{slug}'
*/
show8862c2e54ef5beb858de0ed053b1502aForm.get = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show8862c2e54ef5beb858de0ed053b1502a.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/packages/{slug}'
*/
show8862c2e54ef5beb858de0ed053b1502aForm.head = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show8862c2e54ef5beb858de0ed053b1502a.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

show8862c2e54ef5beb858de0ed053b1502a.form = show8862c2e54ef5beb858de0ed053b1502aForm
/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/admin/packages/{package}'
*/
const showcb8fbee90162dc8cafbf10d68c7b43c6 = (args: { package: string | number } | [packageParam: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: showcb8fbee90162dc8cafbf10d68c7b43c6.url(args, options),
    method: 'get',
})

showcb8fbee90162dc8cafbf10d68c7b43c6.definition = {
    methods: ["get","head"],
    url: '/admin/packages/{package}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/admin/packages/{package}'
*/
showcb8fbee90162dc8cafbf10d68c7b43c6.url = (args: { package: string | number } | [packageParam: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { package: args }
    }

    if (Array.isArray(args)) {
        args = {
            package: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        package: args.package,
    }

    return showcb8fbee90162dc8cafbf10d68c7b43c6.definition.url
            .replace('{package}', parsedArgs.package.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/admin/packages/{package}'
*/
showcb8fbee90162dc8cafbf10d68c7b43c6.get = (args: { package: string | number } | [packageParam: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: showcb8fbee90162dc8cafbf10d68c7b43c6.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/admin/packages/{package}'
*/
showcb8fbee90162dc8cafbf10d68c7b43c6.head = (args: { package: string | number } | [packageParam: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: showcb8fbee90162dc8cafbf10d68c7b43c6.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/admin/packages/{package}'
*/
const showcb8fbee90162dc8cafbf10d68c7b43c6Form = (args: { package: string | number } | [packageParam: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: showcb8fbee90162dc8cafbf10d68c7b43c6.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/admin/packages/{package}'
*/
showcb8fbee90162dc8cafbf10d68c7b43c6Form.get = (args: { package: string | number } | [packageParam: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: showcb8fbee90162dc8cafbf10d68c7b43c6.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::show
* @see app/Http/Controllers/TourPackageController.php:36
* @route '/admin/packages/{package}'
*/
showcb8fbee90162dc8cafbf10d68c7b43c6Form.head = (args: { package: string | number } | [packageParam: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: showcb8fbee90162dc8cafbf10d68c7b43c6.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

showcb8fbee90162dc8cafbf10d68c7b43c6.form = showcb8fbee90162dc8cafbf10d68c7b43c6Form

/**
* Multiple routes resolve to \App\Http\Controllers\TourPackageController::show, so this export is a
* dictionary keyed by URI rather than a callable. Call a specific route with `show['<uri>'](...)`,
* or import the route by name from your generated `routes/` directory.
*/
export const show = {
    '/packages/{slug}': show8862c2e54ef5beb858de0ed053b1502a,
    '/admin/packages/{package}': showcb8fbee90162dc8cafbf10d68c7b43c6,
}

/**
* @see \App\Http\Controllers\TourPackageController::index
* @see app/Http/Controllers/TourPackageController.php:15
* @route '/admin/packages'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/packages',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\TourPackageController::index
* @see app/Http/Controllers/TourPackageController.php:15
* @route '/admin/packages'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\TourPackageController::index
* @see app/Http/Controllers/TourPackageController.php:15
* @route '/admin/packages'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::index
* @see app/Http/Controllers/TourPackageController.php:15
* @route '/admin/packages'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\TourPackageController::index
* @see app/Http/Controllers/TourPackageController.php:15
* @route '/admin/packages'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::index
* @see app/Http/Controllers/TourPackageController.php:15
* @route '/admin/packages'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::index
* @see app/Http/Controllers/TourPackageController.php:15
* @route '/admin/packages'
*/
indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

index.form = indexForm

/**
* @see \App\Http\Controllers\TourPackageController::create
* @see app/Http/Controllers/TourPackageController.php:48
* @route '/admin/packages/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/packages/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\TourPackageController::create
* @see app/Http/Controllers/TourPackageController.php:48
* @route '/admin/packages/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\TourPackageController::create
* @see app/Http/Controllers/TourPackageController.php:48
* @route '/admin/packages/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::create
* @see app/Http/Controllers/TourPackageController.php:48
* @route '/admin/packages/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\TourPackageController::create
* @see app/Http/Controllers/TourPackageController.php:48
* @route '/admin/packages/create'
*/
const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::create
* @see app/Http/Controllers/TourPackageController.php:48
* @route '/admin/packages/create'
*/
createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::create
* @see app/Http/Controllers/TourPackageController.php:48
* @route '/admin/packages/create'
*/
createForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

create.form = createForm

/**
* @see \App\Http\Controllers\TourPackageController::store
* @see app/Http/Controllers/TourPackageController.php:55
* @route '/admin/packages'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/packages',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\TourPackageController::store
* @see app/Http/Controllers/TourPackageController.php:55
* @route '/admin/packages'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\TourPackageController::store
* @see app/Http/Controllers/TourPackageController.php:55
* @route '/admin/packages'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\TourPackageController::store
* @see app/Http/Controllers/TourPackageController.php:55
* @route '/admin/packages'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\TourPackageController::store
* @see app/Http/Controllers/TourPackageController.php:55
* @route '/admin/packages'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

/**
* @see \App\Http\Controllers\TourPackageController::edit
* @see app/Http/Controllers/TourPackageController.php:88
* @route '/admin/packages/{package}/edit'
*/
export const edit = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/packages/{package}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\TourPackageController::edit
* @see app/Http/Controllers/TourPackageController.php:88
* @route '/admin/packages/{package}/edit'
*/
edit.url = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { package: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { package: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            package: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        package: typeof args.package === 'object'
        ? args.package.id
        : args.package,
    }

    return edit.definition.url
            .replace('{package}', parsedArgs.package.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\TourPackageController::edit
* @see app/Http/Controllers/TourPackageController.php:88
* @route '/admin/packages/{package}/edit'
*/
edit.get = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::edit
* @see app/Http/Controllers/TourPackageController.php:88
* @route '/admin/packages/{package}/edit'
*/
edit.head = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\TourPackageController::edit
* @see app/Http/Controllers/TourPackageController.php:88
* @route '/admin/packages/{package}/edit'
*/
const editForm = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::edit
* @see app/Http/Controllers/TourPackageController.php:88
* @route '/admin/packages/{package}/edit'
*/
editForm.get = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: edit.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\TourPackageController::edit
* @see app/Http/Controllers/TourPackageController.php:88
* @route '/admin/packages/{package}/edit'
*/
editForm.head = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: edit.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

edit.form = editForm

/**
* @see \App\Http\Controllers\TourPackageController::update
* @see app/Http/Controllers/TourPackageController.php:95
* @route '/admin/packages/{package}'
*/
export const update = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/admin/packages/{package}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\TourPackageController::update
* @see app/Http/Controllers/TourPackageController.php:95
* @route '/admin/packages/{package}'
*/
update.url = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { package: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { package: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            package: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        package: typeof args.package === 'object'
        ? args.package.id
        : args.package,
    }

    return update.definition.url
            .replace('{package}', parsedArgs.package.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\TourPackageController::update
* @see app/Http/Controllers/TourPackageController.php:95
* @route '/admin/packages/{package}'
*/
update.put = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \App\Http\Controllers\TourPackageController::update
* @see app/Http/Controllers/TourPackageController.php:95
* @route '/admin/packages/{package}'
*/
update.patch = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\TourPackageController::update
* @see app/Http/Controllers/TourPackageController.php:95
* @route '/admin/packages/{package}'
*/
const updateForm = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\TourPackageController::update
* @see app/Http/Controllers/TourPackageController.php:95
* @route '/admin/packages/{package}'
*/
updateForm.put = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\TourPackageController::update
* @see app/Http/Controllers/TourPackageController.php:95
* @route '/admin/packages/{package}'
*/
updateForm.patch = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PATCH',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

update.form = updateForm

/**
* @see \App\Http\Controllers\TourPackageController::destroy
* @see app/Http/Controllers/TourPackageController.php:141
* @route '/admin/packages/{package}'
*/
export const destroy = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/packages/{package}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\TourPackageController::destroy
* @see app/Http/Controllers/TourPackageController.php:141
* @route '/admin/packages/{package}'
*/
destroy.url = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { package: args }
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { package: args.id }
    }

    if (Array.isArray(args)) {
        args = {
            package: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        package: typeof args.package === 'object'
        ? args.package.id
        : args.package,
    }

    return destroy.definition.url
            .replace('{package}', parsedArgs.package.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\TourPackageController::destroy
* @see app/Http/Controllers/TourPackageController.php:141
* @route '/admin/packages/{package}'
*/
destroy.delete = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\TourPackageController::destroy
* @see app/Http/Controllers/TourPackageController.php:141
* @route '/admin/packages/{package}'
*/
const destroyForm = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\TourPackageController::destroy
* @see app/Http/Controllers/TourPackageController.php:141
* @route '/admin/packages/{package}'
*/
destroyForm.delete = (args: { package: number | { id: number } } | [packageParam: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroy.form = destroyForm

const TourPackageController = { show, index, create, store, edit, update, destroy }

export default TourPackageController