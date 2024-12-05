<?php

    namespace App\Http\Controllers;

    use App\Models\Series;
    use App\Models\Peliculas;
    use Illuminate\Http\Request;

    class PrincipalController extends Controller{
        public function index(){
            $series = Series::paginate(6, ['*'], 'series_page');
            $peliculas = Peliculas::paginate(6, ['*'], 'peliculas_page');
            return view('index', compact('series', 'peliculas'));
        }

        public function series(){
            $series=Series::paginate(10);
            return view('series', compact('series'));
        }

        public function peliculas(){
            $peliculas=Peliculas::paginate(10);
            return view('peliculas', compact('peliculas'));
        }

        public function genero($genero){
            $series = Series::where('genero', $genero)->paginate(6);
            $peliculas = Peliculas::where('genero', $genero)->paginate(6);
        
            return view('index', compact('series', 'peliculas'));
        }




        public function guardar_serie(Request $request, Series $serie){
            $request->validate([
                'titulo' => 'required',
                'titulo_original' => 'required',
                'año_inicio' => 'required',
                'año_fin' => 'required',
                'estado' => 'required',
                'genero' => 'required',
                'sinopsis' => 'required',
                'clasificacion' => 'required',
                'idioma' => 'required',
                'pais' => 'required',
                'creador' => 'required',
                'poster' => 'required'
            ],[
                'titulo.required'  => 'El titulo es obligatorio',
                'titulo_original.required' => 'El titulo original es obligatorio',
                'año_inicio.required' => 'El año de inicio es obligatorio',
                'estado.required' => 'El estado es obligatorio',
                'genero.required' => 'El genero es obligatorio',
                'sinopsis.required' => 'La sinopsis es obligatorio',
                'clasificacion.required' => 'La clasificacion es obligatorio',
                'idioma.required' => 'El idioma es obligatorio',
                'pais.required' => 'El pais es obligatorio',
                'creador.required' => 'El creador es obligatorio',
                'poster.required' => 'El poster es obligatorio'
            ]);

            $poster=time().'.'.$request->poster->extension();
            $request->poster->move(public_path('imagenes/series'), $poster);

            $serie=series::create([
                'titulo' => $request->titulo,
                'titulo_original' => $request->titulo_original,
                'año_inicio' => $request->año_inicio,
                'año_fin' => $request->año_fin,
                'estado' => $request->estado,
                'genero' => $request->genero,
                'sinopsis' => $request->sinopsis,
                'clasificacion' => $request->clasificacion,
                'idioma' => $request->idioma,
                'pais' => $request->pais,
                'creador' => $request->creador,
                'poster' => $poster
            ]);
            return redirect()->route('series')->with('mensaje','Series Guardadas correctamente en BD');
        }

        public function borrar_serie($serie){
            $s=series::find($serie);
            $s->delete();
            return redirect()->route('series')->with('mensaje','Series eliminadas correctamente en BD');
        }


        public function editar_serie(Series $serie){
            return view('editar_serie',compact('serie'));
        }

        public function actualizar_serie(Request $request, Series $serie){
            $request->validate([
                'titulo' => 'required|string|max:50',
                'titulo_original' => 'required|string|max:50',
                'año_inicio' => 'required|integer|min:1900|max:' . date('Y'),
                'año_fin' => 'nullable|integer|min:1900|max:' . date('Y'),
                'estado' => 'required|string|max:100',
                'sinopsis' => 'required|string|max:1000',
                'genero' => 'required|string',
                'clasificacion' => 'required|string',
                'idioma' => 'required|string|max:50',
                'poster' => 'required|image',
            ],[
                'titulo.required'  => 'El titulo es obligatorio',
                'titulo.max:50'  => 'El titulo tiene que ser de maximo 50 caracteres',
                'titulo_original.max:50' => 'El titulo original tiene que ser de maximo 50 caracteres',
                'año_inicio.required' => 'El año de inicio es obligatorio',
                'estado.required' => 'El estado es obligatorio',
                'genero.required' => 'El genero es obligatorio',
                'sinopsis.required' => 'La sinopsis es obligatorio',
                'clasificacion.required' => 'La clasificacion es obligatorio',
                'idioma.required' => 'El idioma es obligatorio',
                'pais.required' => 'El pais es obligatorio',
                'creador.required' => 'El creador es obligatorio',
                'poster.required' => 'El póster es obligatorio',
                'poster.image' => 'El archivo del póster debe ser una imagen',
            ]);

            if ($request->hasFile('poster')) {
                if ($serie->poster && file_exists(public_path('imagenes/series/' . $serie->poster))) {
                    unlink(public_path('imagenes/series/' . $serie->poster));
                }
        
                $poster = time() . '.' . $request->poster->extension();
                $request->poster->move(public_path('imagenes/series'), $poster);
                $serie->poster = $poster;
            }

            $serie->update([
                'titulo' => $request->titulo,
                'titulo_original' => $request->titulo_original,
                'año_inicio' => $request->año_inicio,
                'año_fin' => $request->año_fin,
                'estado' => $request->estado,
                'genero' => $request->genero,
                'sinopsis' => $request->sinopsis,
                'clasificacion' => $request->clasificacion,
                'idioma' => $request->idioma,
                'pais' => $request->pais,
                'creador' => $request->creador,
                'poster' => $poster
            ]);
            $serie->save();
            return redirect()->route('series');
        }

        public function ver_serie(Series $serie){
            return view('ver_serie',compact('serie'));
        }



        public function guardar_pelicula(Request $request, Peliculas $serie){
            $request->validate([
                'titulo' => 'required',
                'titulo_original' => 'required',
                'año_inicio' => 'required',
                'año_fin' => 'required',
                'estado' => 'required',
                'genero' => 'required',
                'sinopsis' => 'required',
                'clasificacion' => 'required',
                'idioma' => 'required',
                'pais' => 'required',
                'creador' => 'required',
                'poster' => 'required'
            ],[
                'titulo.required'  => 'El titulo es obligatorio',
                'titulo_original.required' => 'El titulooriginal es obligatorio',
                'año_inicio.required' => 'El año de inicio es obligatorio',
                'estado.required' => 'El estado es obligatorio',
                'genero.required' => 'El genero es obligatorio',
                'sinopsis.required' => 'La sinopsis es obligatorio',
                'clasificacion.required' => 'La clasificacion es obligatorio',
                'idioma.required' => 'El idioma es obligatorio',
                'pais.required' => 'El pais es obligatorio',
                'creador.required' => 'El creador es obligatorio',
                'poster.required' => 'El poster es obligatorio'
            ]);

            $poster=time().'.'.$request->poster->extension();
            $request->poster->move(public_path('imagenes/peliculas'), $poster);

            $serie=Peliculas::create([
                'titulo' => $request->titulo,
                'titulo_original' => $request->titulo_original,
                'año_inicio' => $request->año_inicio,
                'año_fin' => $request->año_fin,
                'estado' => $request->estado,
                'genero' => $request->genero,
                'sinopsis' => $request->sinopsis,
                'clasificacion' => $request->clasificacion,
                'idioma' => $request->idioma,
                'pais' => $request->pais,
                'creador' => $request->creador,
                'poster' => $poster
            ]);
            return redirect()->route('index')->with('mensaje','Peliculas Guardadas correctamente en BD');
        }

        public function borrar_pelicula($pelicula){
            $s=Peliculas::find($pelicula);
            $s->delete();
            return redirect()->route('index')->with('mensaje','Peliculas eliminadas correctamente en BD');
        }


        public function editar_pelicula(Peliculas $pelicula){
            return view('editar_pelicula',compact('pelicula'));
        }

        public function actualizar_pelicula(Request $request, Peliculas $pelicula){
            $request->validate([
                'titulo' => 'required',
                'titulo_original' => 'required',
                'año_estreno' => 'required',
                'duracion' => 'required',
                'genero' => 'required',
                'sinopsis' => 'required',
                'clasificacion' => 'required',
                'idioma' => 'required',
                'poster' => 'image',
            ], [
                'titulo.required' => 'El título es obligatorio',
                'titulo_original.required' => 'El título original es obligatorio',
                'año_estreno.required' => 'El año de estreno es obligatorio',
                'duracion.required' => 'La duración es obligatoria',
                'genero.required' => 'El género es obligatorio',
                'sinopsis.required' => 'La sinopsis es obligatoria',
                'clasificacion.required' => 'La clasificación es obligatoria',
                'idioma.required' => 'El idioma es obligatorio',
                'poster.image' => 'El archivo debe ser una imagen',
            ]);

            if ($request->hasFile('poster')) {
                if ($pelicula->poster && file_exists(public_path('imagenes/peliculas/' . $pelicula->poster))) {
                    unlink(public_path('imagenes/peliculas/' . $pelicula->poster));
                }

                $poster = time() . '.' . $request->poster->extension();
                $request->poster->move(public_path('imagenes/peliculas/'), $poster);
                $pelicula->poster = $poster;
                $pelicula->update([
                    'poster' => $pelicula->poster,
                ]);
            }

            $pelicula->update([
                'titulo' => $request->titulo,
                'titulo_original' => $request->titulo_original,
                'año_estreno' => $request->año_estreno,
                'duracion' => $request->duracion,
                'genero' => $request->genero,
                'sinopsis' => $request->sinopsis,
                'clasificacion' => $request->clasificacion,
                'idioma' => $request->idioma
            ]);

            return redirect()->route('peliculas')->with('success', 'Película actualizada correctamente.');
        }

        public function ver_pelicula(Peliculas $pelicula){
            return view('ver_pelicula',compact('pelicula'));
        }


        


        public function buscar(Request $request){
            $buscar = $request->input('buscar');

            if (!$buscar) {
                return redirect()->back()->with('error', 'Por favor, ingresa un término de búsqueda.');
            }

            $series = Series::query()->where(function ($query) use ($buscar) {
                $query->where('titulo', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('titulo_original', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('estado', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('genero', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('clasificacion', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('idioma', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('pais', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('creador', 'LIKE', '%' . $buscar . '%');
            })->paginate(5);

            $peliculas = Peliculas::query()->where(function ($query) use ($buscar) {
                $query->where('titulo', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('titulo_original', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('genero', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('clasificacion', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('idioma', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('pais', 'LIKE', '%' . $buscar . '%')
                    ->orWhere('creador', 'LIKE', '%' . $buscar . '%');
            })->paginate(5);

            return view('index', compact('series', 'peliculas'));
        }
    } 