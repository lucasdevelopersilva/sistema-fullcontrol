public class FragmentRadioAdminPanel extends Fragment implements OnClickListener, PermissionsFragment, CollapseControllingFragment, Tools.EventListener {

    private RadioManager radioManager;
    private Activity activity;
    private RoundedImageView albumArtView;
    private RoundedImageView agenda_albumArt;
    private RoundedImageView agendapadrao;
    private RoundedImageView logo;
    private RelativeLayout relativeLayout;
    private ProgressBar progressBar;
    private ImageView buttonPlayPause;
    private Toolbar toolbar;
    private MainActivity mainActivity;
    EqualizerView equalizerView;
    LinearLayout ll_menu, menu_play;
    AudioManager audioManager;
    AppCompatSeekBar appCompatSeekBar;
    ImageButton img_volume;
    LinearLayout lyt_volume_bar;
    private InterstitialAd interstitialAd;
    private LinearLayout ll_agenda;
    int counter = 1;
    private String radio_url, radio_name, radio_image;
    TextView agenda_now_playing, agenda_descricao, nowPlayingTitle, nowPlaying;
    private ImageView iv_bg;
    private ImageView btn_share, btn_whatsapp;
    private Timer autoUpdate;
    LinearLayout btn_site, btn_facebook, btn_instagram, btn_tv, btn_noticias, btn_youtube, btn_progamacao, btn_mural, btn_twitter;

    private View contente_padrao;

    public FragmentRadioAdminPanel() {
        // Required empty public constructor
    }

    private ArrayList<Agenda> agendaArrayList = new ArrayList<>();

    @Override
    public void onAttach(Activity activity) {
        super.onAttach(activity);
        mainActivity = (MainActivity) activity;
    }


    /**
     * Called when the activity is first created.
     */
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        relativeLayout = (RelativeLayout) inflater.inflate(R.layout.fragment_radio, container, false);
        ll_menu = (LinearLayout) relativeLayout.findViewById(R.id.ll_menu);
        lyt_volume_bar = (LinearLayout) relativeLayout.findViewById(R.id.lyt_volume_bar);
        iv_bg = (ImageView) relativeLayout.findViewById(R.id.iv_bg);
        toolbar = (Toolbar) relativeLayout.findViewById(R.id.toolbar);

        nowPlayingTitle = relativeLayout.findViewById(R.id.now_playing_title);
        nowPlaying = relativeLayout.findViewById(R.id.now_playing);
        nowPlaying.setSelected(true);
        nowPlaying.setSingleLine();

        equalizerView = relativeLayout.findViewById(R.id.equalizer_view);
        menu_play = (LinearLayout) relativeLayout.findViewById(R.id.menu_play);
        ll_agenda = (LinearLayout) relativeLayout.findViewById(R.id.ll_agenda);
        agenda_now_playing = relativeLayout.findViewById(R.id.agenda_now_playing);
        agenda_descricao = relativeLayout.findViewById(R.id.agenda_descricao);
        agenda_descricao.setSelected(true);
        agenda_now_playing.setSelected(true);
        agenda_albumArt = (RoundedImageView) relativeLayout.findViewById(R.id.agenda_albumArt);
        contente_padrao = (View) relativeLayout.findViewById(R.id.contente_padrao);


        setupToolbar();

        loadInterstitialAd();

        setHasOptionsMenu(true);

        initializeUIElements();

        carregarMenu();

        //if(Config.STATUS_RADIO){
            carregarProgramacao();
        //}


        if (!Config.STATUS_RADIO) {
            nowPlayingTitle.setVisibility(View.GONE);
            nowPlaying.setVisibility(View.GONE);
            equalizerView.setVisibility(View.GONE);
            menu_play.setVisibility(View.GONE);
            contente_padrao.setVisibility(View.GONE);
            ll_agenda.setVisibility(View.GONE);
        }


        if (Config.ENABLE_AUTO_PLAY && Config.STATUS_RADIO) {
            new Handler().postDelayed(new Runnable() {
                @Override
                public void run() {
                    buttonPlayPause.performClick();
                }
            }, 1000);
        }

        if (Config.ENABLE_VOLUME_BAR && Config.STATUS_RADIO) {
            lyt_volume_bar.setVisibility(View.VISIBLE);
            initVolumeBar();
        } else {
            lyt_volume_bar.setVisibility(View.GONE);
        }

        //Initialize visualizer or imageview for album art
        if (Config.ENABLE_ALBUM_ART) {
            albumArtView.setVisibility(View.VISIBLE);
        } else {
            albumArtView.setVisibility(View.GONE);
        }

        if (Config.ENABLE_CIRCULAR_IMAGE_ALBUM_ART) {
            albumArtView.setOval(true);
        } else {
            albumArtView.setOval(false);
        }

     /*   if (Config.ENABLE_CIRCULAR_IMAGE_PADRAO) {
            agendapadrao.setOval(true);
        } else {
            agendapadrao.setOval(false);
        }*/

        if (Config.ENABLE_CIRCULAR_IMAGE_PROGAMACAO) {
            agenda_albumArt.setOval(true);
        } else {
            agenda_albumArt.setOval(false);
        }

        if (Config.EXIBIR_BT_SITE) {
            btn_site.setVisibility(View.VISIBLE);
            ll_menu.setVisibility(View.VISIBLE);
        } else {
            btn_site.setVisibility(View.GONE);
        }

        if (Config.EXIBIR_BT_TWITTER) {
            btn_twitter.setVisibility(View.VISIBLE);
            ll_menu.setVisibility(View.VISIBLE);
        } else {
            btn_twitter.setVisibility(View.GONE);
        }

      /*  if (Config.EXIBIR_BT_PROGAMACAO) {
            btn_progamacao.setVisibility(View.VISIBLE);
            ll_menu.setVisibility(View.VISIBLE);
        } else {
            btn_progamacao.setVisibility(View.GONE);
        }*/

     /*   if (Config.EXIBIR_BT_MURAL) {
            btn_mural.setVisibility(View.VISIBLE);
            ll_menu.setVisibility(View.VISIBLE);
        } else {
            btn_mural.setVisibility(View.GONE);
        }*/

        if (Config.EXIBIR_BT_TV) {
            btn_tv.setVisibility(View.VISIBLE);
            ll_menu.setVisibility(View.VISIBLE);
        } else {
            btn_tv.setVisibility(View.GONE);
        }

        if (Config.EXIBIR_BT_NOTICIAS) {
            btn_noticias.setVisibility(View.VISIBLE);
            ll_menu.setVisibility(View.VISIBLE);
        } else {
            btn_noticias.setVisibility(View.GONE);
        }

        if (Config.EXIBIR_BT_YOUTUBE) {
            btn_youtube.setVisibility(View.VISIBLE);
            ll_menu.setVisibility(View.VISIBLE);
        } else {
            btn_youtube.setVisibility(View.GONE);
        }

        if (Config.EXIBIR_BT_FACEBBOK) {
            btn_facebook.setVisibility(View.VISIBLE);
            ll_menu.setVisibility(View.VISIBLE);
        } else {
            btn_facebook.setVisibility(View.GONE);
        }

        if (Config.EXIBIR_BT_WHATSAPP) {
            btn_whatsapp.setVisibility(View.VISIBLE);
            menu_play.setVisibility(View.VISIBLE);
        } else {
            btn_whatsapp.setVisibility(View.GONE);
        }

        if (Config.EXIBIR_BT_INSTAGRAM) {
            btn_instagram.setVisibility(View.VISIBLE);
            ll_menu.setVisibility(View.VISIBLE);
        } else {
            btn_instagram.setVisibility(View.GONE);
        }

        //albumArtView.setImageResource(Tools.BACKGROUND_IMAGE_ID);


        onBackPressed();


        btn_whatsapp.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(Intent.ACTION_VIEW, Uri.parse(Config.WHATSAPP_URL)));
            }
        });

        btn_share.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent sendInt = new Intent(Intent.ACTION_SEND);
                sendInt.putExtra(Intent.EXTRA_SUBJECT, getString(R.string.app_name));
                sendInt.putExtra(Intent.EXTRA_TEXT, getString(R.string.share_text) + "\nhttps://play.google.com/store/apps/details?id=" + getActivity().getPackageName());
                sendInt.setType("text/plain");
                startActivity(Intent.createChooser(sendInt, "Share"));
            }
        });

        btn_facebook.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(Intent.ACTION_VIEW, Uri.parse(Config.FACEBOOK_URL)));
            }
        });

        btn_instagram.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(activity.getApplicationContext(), ActivitySite.class).putExtra("url", Config.INSTAGRAM_URL));
            }
        });

        btn_twitter.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(activity.getApplicationContext(), ActivitySite.class).putExtra("url", Config.TWITTER_URL));
            }
        });

        btn_site.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(activity.getApplicationContext(), ActivitySite.class).putExtra("url", Config.SITE_URL));
            }
        });

        btn_youtube.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                radioManager = RadioManager.with();

                if (radioManager.isPlaying()) {
                    radioManager.stopServices();
                }
                startActivity(new Intent(activity.getApplicationContext(), ActivitySite.class).putExtra("url", Config.YOUTUBE_URL));
            }
        });

        btn_tv.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                radioManager = RadioManager.with();

                if (radioManager.isPlaying()) {
                    radioManager.stopServices();
                }
                startActivity(new Intent(activity.getApplicationContext(), Tv.class));
            }
        });

    /*    btn_mural.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(activity.getApplicationContext(), Mural.class));
            }
        });*/

        btn_noticias.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(activity.getApplicationContext(), Noticias.class));
              //  startActivity(new Intent(activity.getApplicationContext(), Equipe.class));
            }
        });

     /*   btn_progamacao.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(activity.getApplicationContext(), Progamacao.class));
            }
        });*/

        return relativeLayout;
    }


    private void carregarMenu() {
        StringRequest postRequest = new StringRequest(Request.Method.GET, Config.ADMIN_PANEL_URL+"/get_MenuApp",
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        JSONArray jsonArr = null;

                        try {
                            jsonArr = new JSONArray(response);
                            JSONObject jsonObj = jsonArr.getJSONObject(0);
                    Log.e("dados", (String) jsonObj.get("tv_status"));
                            if (jsonObj.optString("tv_status").equalsIgnoreCase("true")) {
                                Config.TV_URL = "" + jsonObj.get("tv_link");
                                btn_tv.setVisibility(View.VISIBLE);
                            } else {
                                btn_tv.setVisibility(View.GONE);
                            }

                            if (jsonObj.optString("facebook_status").equalsIgnoreCase("true")) {
                                Config.FACEBOOK_URL = "" + jsonObj.get("facebook_link");
                                btn_facebook.setVisibility(View.VISIBLE);
                            } else {
                                btn_facebook.setVisibility(View.GONE);
                            }

                            if (jsonObj.optString("whatsapp_status").equalsIgnoreCase("true")) {
                                Config.WHATSAPP_URL = "" + jsonObj.get("whatsapp_link");
                                btn_whatsapp.setVisibility(View.VISIBLE);
                            } else {
                                btn_whatsapp.setVisibility(View.GONE);
                            }

                            if (jsonObj.optString("instagram_status").equalsIgnoreCase("true")) {
                                Config.INSTAGRAM_URL = "" + jsonObj.get("instagram_link");
                                btn_instagram.setVisibility(View.VISIBLE);
                            } else {
                                btn_instagram.setVisibility(View.GONE);
                            }

                           if (jsonObj.optString("site_status").equalsIgnoreCase("true")) {
                                Config.SITE_URL = "" + jsonObj.get("site_link");
                                btn_site.setVisibility(View.VISIBLE);
                            } else {
                                btn_site.setVisibility(View.GONE);
                            }

                            if (jsonObj.optString("youtube_status").equalsIgnoreCase("true")) {
                                Config.YOUTUBE_URL = "" + jsonObj.get("youtube_link");
                                btn_youtube.setVisibility(View.VISIBLE);
                            } else {
                                btn_youtube.setVisibility(View.GONE);
                            }

//                           if (jsonObj.optString("programacao_status").equalsIgnoreCase("true")) {
//                                btn_progamacao.setVisibility(View.VISIBLE);
//                            } else {
//                                btn_progamacao.setVisibility(View.GONE);
//                            }

                            if (jsonObj.optString("twitter_status").equalsIgnoreCase("true")) {
                                Config.TWITTER_URL = "" + jsonObj.get("twitter_link");
                                btn_twitter.setVisibility(View.VISIBLE);
                            } else {
                                btn_twitter.setVisibility(View.GONE);
                            }

//                            if (jsonObj.optString("recados_status").equalsIgnoreCase("true")) {
//                                btn_mural.setVisibility(View.VISIBLE);
//                            } else {
//                                btn_mural.setVisibility(View.GONE);
//                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }

                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<String, String>();
                params.put("get_MenuApp", "get_MenuApp");

                return params;
            }
        };

        RequestQueue mRequestQueue = Volley.newRequestQueue(getApplicationContext());
        // Adding request to request queue
        mRequestQueue.add(postRequest);

    }


    private void carregarProgramacao() {

        agendaArrayList.clear();
        StringRequest postRequest = new StringRequest(Request.Method.GET, Config.ADMIN_PANEL_URL+"/get_programacao_atual",
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        if (response.length() > 0) {
                            JSONArray jsonArr = null;
                            try {
                                jsonArr = new JSONArray(response);
                                for (int i = 0; i < jsonArr.length(); i++) {
                                    JSONObject jsonObj = jsonArr.getJSONObject(i);
                                    Agenda agenda = new Agenda();
                                    agenda.setDia(jsonObj.optString("dia"));
                                    agenda.setFim(jsonObj.optString("fim"));
                                    agenda.setInicio(jsonObj.optString("inicio"));
                                    agenda.setImg_agenda(jsonObj.optString("img_agenda"));
                                    agenda.setPrograma(jsonObj.optString("programa"));
                                    agenda.setDescricao(jsonObj.optString("descricao"));

                                    agendaArrayList.add(agenda);

                                }
                                configurarProgramacao();


                            } catch (JSONException e) {
                                e.printStackTrace();
                            }


                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<String, String>();
                params.put("get_programacao_atual", "get_programacao_atual");

                return params;
            }
        };


        RequestQueue mRequestQueue = Volley.newRequestQueue(getActivity());
        // Adding request to request queue
        mRequestQueue.add(postRequest);


    }


    private void configurarProgramacao() {
        Date date = new Date();
        int dayOfWeek = date.getDay();

        String horaAtual = new SimpleDateFormat("HH:mm").format(new Date().getTime());


        if (agendaArrayList.size() == 0) {
           // contente_padrao.setVisibility(View.VISIBLE);
           // ll_agenda.setVisibility(View.GONE);
        }
        boolean programacaoAtiva = false;

        contente_padrao.setVisibility(View.GONE);
        ll_agenda.setVisibility(View.GONE);


        for (int i = 0; i < agendaArrayList.size(); i++) {
            Agenda agenda = agendaArrayList.get(i);

            if (comparaHora(agenda.getInicio(), horaAtual) && comparaHora(horaAtual, agenda.getFim()) && agenda.getDia().equals("Domingo") && dayOfWeek == 0) {
                ll_agenda.setVisibility(View.VISIBLE);
                agenda_now_playing.setText(agenda.getPrograma());
                agenda_descricao.setText(agenda.getDescricao());
                Picasso.with(getActivity()).load(agenda.getImg_agenda()).fit().into(agenda_albumArt);
                programacaoAtiva = true;
                contente_padrao.setVisibility(View.GONE);
                break;

            }
            if (comparaHora(agenda.getInicio(), horaAtual) && comparaHora(horaAtual, agenda.getFim()) && agenda.getDia().equals("Segunda-Feira") && dayOfWeek == 1) {
                ll_agenda.setVisibility(View.VISIBLE);
                agenda_now_playing.setText(agenda.getPrograma());
                agenda_descricao.setText(agenda.getDescricao());
                Picasso.with(getActivity()).load(agenda.getImg_agenda()).fit().into(agenda_albumArt);
                programacaoAtiva = true;
                contente_padrao.setVisibility(View.GONE);
                break;
            }
            if (comparaHora(agenda.getInicio(), horaAtual) && comparaHora(horaAtual, agenda.getFim()) && agenda.getDia().equals("Terça-Feira") && dayOfWeek == 2) {
                ll_agenda.setVisibility(View.VISIBLE);
                agenda_now_playing.setText(agenda.getPrograma());
                agenda_descricao.setText(agenda.getDescricao());
                Picasso.with(getActivity()).load(agenda.getImg_agenda()).fit().into(agenda_albumArt);
                programacaoAtiva = true;
                contente_padrao.setVisibility(View.GONE);
                break;
            }
            if (comparaHora(agenda.getInicio(), horaAtual) && comparaHora(horaAtual, agenda.getFim()) && agenda.getDia().equals("Quarta-Feira") && dayOfWeek == 3) {
                ll_agenda.setVisibility(View.VISIBLE);
                agenda_now_playing.setText(agenda.getPrograma());
                agenda_descricao.setText(agenda.getDescricao());
                Picasso.with(getActivity()).load(agenda.getImg_agenda()).fit().into(agenda_albumArt);
                programacaoAtiva = true;
                contente_padrao.setVisibility(View.GONE);
                break;
            }
            if (comparaHora(agenda.getInicio(), horaAtual) && comparaHora(horaAtual, agenda.getFim()) && agenda.getDia().equals("Quinta-Feira") && dayOfWeek == 4) {
                ll_agenda.setVisibility(View.VISIBLE);
                agenda_now_playing.setText(agenda.getPrograma());
                agenda_descricao.setText(agenda.getDescricao());
                Picasso.with(getActivity()).load(agenda.getImg_agenda()).fit().into(agenda_albumArt);
                programacaoAtiva = true;
                contente_padrao.setVisibility(View.GONE);
                break;
            }
            if (comparaHora(agenda.getInicio(), horaAtual) && comparaHora(horaAtual, agenda.getFim()) && agenda.getDia().equals("Sexta-Feira") && dayOfWeek == 5) {
                ll_agenda.setVisibility(View.VISIBLE);
                agenda_now_playing.setText(agenda.getPrograma());
                agenda_descricao.setText(agenda.getDescricao());
                Picasso.with(getActivity()).load(agenda.getImg_agenda()).fit().into(agenda_albumArt);
                programacaoAtiva = true;
                contente_padrao.setVisibility(View.GONE);
                break;
            }
            if (comparaHora(agenda.getInicio(), horaAtual) && comparaHora(horaAtual, agenda.getFim()) && agenda.getDia().equals("Sábado") && dayOfWeek == 6) {
                ll_agenda.setVisibility(View.VISIBLE);
                agenda_now_playing.setText(agenda.getPrograma());
                agenda_descricao.setText(agenda.getDescricao());
                Picasso.with(getActivity()).load(agenda.getImg_agenda()).fit().into(agenda_albumArt);
                programacaoAtiva = true;
                contente_padrao.setVisibility(View.GONE);
                break;
            }

        }

        if(!Config.STATUS_RADIO){
            contente_padrao.setVisibility(View.GONE);
            ll_agenda.setVisibility(View.GONE);
        }else if(!Config.STATUS_RADIO){
            contente_padrao.setVisibility(View.VISIBLE);
            ll_agenda.setVisibility(View.GONE);
        }

        if (!programacaoAtiva && Config.STATUS_RADIO) {
            contente_padrao.setVisibility(View.VISIBLE);
            ll_agenda.setVisibility(View.GONE);
        }
    }


    private boolean comparaHora(String time, String endtime) {

        String pattern = "HH:mm";
        SimpleDateFormat sdf = new SimpleDateFormat(pattern);

        try {
            Date date1 = sdf.parse(time);
            Date date2 = sdf.parse(endtime);

            if (date1.before(date2)) {
                return true;
            } else {

                return false;
            }
        } catch (ParseException e) {
            e.printStackTrace();
        }
        return false;
    }


    private void setupToolbar() {
        //toolbar.setTitle(getString(R.string.app_name));
        //mainActivity.setSupportActionBar(toolbar);
    }


    @Override
    public void onActivityCreated(Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);
        mainActivity.setupNavigationDrawer(toolbar);
        activity = getActivity();

        if (Tools.isNetworkActive(getActivity())) {
            new MyTask().execute(Config.ADMIN_PANEL_URL+"/get_config");
        } else {
            Toast.makeText(getActivity(), getResources().getString(R.string.dialog_internet_description), Toast.LENGTH_SHORT).show();
        }

        Tools.isOnlineShowDialog(activity);

        //Get the radioManager
        radioManager = RadioManager.with();

        progressBar.setVisibility(View.VISIBLE);

        //Obtain the actual radio url
        AsyncTask.execute(new Runnable() {
            @Override
            public void run() {
                activity.runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        progressBar.setVisibility(View.INVISIBLE);
                        updateButtons();
                    }
                });
            }
        });

        if (isPlaying()) {
            onAudioSessionId(RadioManager.getService().getAudioSessionId());
        }

    }


    @Override
    public void onEvent(String status) {

        switch (status) {
            case PlaybackStatus.LOADING:
                progressBar.setVisibility(View.VISIBLE);
                break;

            case PlaybackStatus.ERROR:
                makeSnackBar(R.string.error_retry);
                break;
        }

        if (!status.equals(PlaybackStatus.LOADING))
            progressBar.setVisibility(View.INVISIBLE);

        updateButtons();

    }

    @Override
    public void onAudioSessionId(Integer i) {

    }


    @Override
    public void onStart() {
        super.onStart();
        Tools.registerAsListener(this);
    }

    @Override
    public void onStop() {
        Tools.unregisterAsListener(this);
        super.onStop();

    }

    @Override
    public void onDestroy() {
        radioManager.isPlaying();
        radioManager.unbind(getContext());
        //audioVisualization.release();
        super.onDestroy();
    }

    @Override
    public void onPause() {
        super.onPause();
        autoUpdate.cancel();
    }

    @Override
    public void onResume() {
        super.onResume();
     /*   final Handler handler = new Handler();
        final Runnable runnable = new Runnable() {
            @Override
            public void run() {
                carregarProgramacao();
                handler.postDelayed(this,6000);//60 second delay
            }
        };handler.postDelayed(runnable,0);*/

        autoUpdate = new Timer();
        autoUpdate.schedule(new TimerTask() {
            @Override
            public void run() {
                runOnUiThread(new Runnable() {
                    public void run() {
                        carregarProgramacao();
                    }
                });

            }
        }, 0, 20000); // updates each 40 secs


        updateButtons();
        radioManager.bind(getContext());

     /*   if (audioVisualization != null)
            audioVisualization.onResume();*/
    }


    private class MyTask extends AsyncTask<String, Void, String> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            buttonPlayPause.setVisibility(View.INVISIBLE);
            nowPlaying.setText(R.string.loading_progress);
        }

        @Override
        protected String doInBackground(String... params) {
            Log.e("livro", "teste " + params[0]);
            return Tools.getJSONString(params[0]);
        }

        @Override
        protected void onPostExecute(String result) {
            super.onPostExecute(result);

            buttonPlayPause.setVisibility(View.VISIBLE);

            if (null == result || result.length() == 0) {
                Toast.makeText(getActivity(), getResources().getString(R.string.dialog_internet_description), Toast.LENGTH_SHORT).show();

            } else {

                try {
                    JSONObject mainJson = new JSONObject(result);
                    JSONArray jsonArray = mainJson.getJSONArray("result");
                    JSONObject c = null;
                    for (int i = 0; i < jsonArray.length(); i++) {
                        c = jsonArray.getJSONObject(i);

                        radio_name = c.getString("radio_name");
                        radio_url = c.getString("radio_url");
                        String bg =  c.getString("radio_bg");
                        radio_image =  c.getString("radio_image");
                        Picasso.with(getContext()).load(bg).fit().into(iv_bg);
                        Picasso.with(getContext()).load(radio_image).fit().into(logo);

                        Log.e("livro", "url " + radio_image);
                        Constant.itemRadio = new ItemRadio(radio_name, radio_url);

                    }

                    nowPlayingTitle.setText(R.string.now_playing);
                    nowPlaying.setText(radio_name);

                    if (Config.ENABLE_AUTO_PLAY && Config.STATUS_RADIO) {
                        new Handler().postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                buttonPlayPause.performClick();
                            }
                        }, 1000);
                    } else {
                        Log.d("INFO", "Auto play is disabled");
                    }

                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }
    }

    @SuppressLint("WrongViewCast")
    private void initializeUIElements() {
        btn_whatsapp = (ImageView) relativeLayout.findViewById(R.id.btn_whatsapp);
        btn_site = (LinearLayout) relativeLayout.findViewById(R.id.btn_site);
        btn_tv = (LinearLayout) relativeLayout.findViewById(R.id.btn_tv);
        btn_facebook = (LinearLayout) relativeLayout.findViewById(R.id.btn_facebook);
        btn_share = (ImageView) relativeLayout.findViewById(R.id.btn_share);
        btn_instagram = (LinearLayout) relativeLayout.findViewById(R.id.btn_instagram);
        btn_twitter = (LinearLayout) relativeLayout.findViewById(R.id.btn_twitter);
        //btn_mural = (LinearLayout) relativeLayout.findViewById(R.id.btn_mural);
        btn_noticias = (LinearLayout) relativeLayout.findViewById(R.id.btn_noticias);
        btn_youtube = (LinearLayout) relativeLayout.findViewById(R.id.btn_youtube);
        menu_play = (LinearLayout) relativeLayout.findViewById(R.id.menu_play);
        progressBar = relativeLayout.findViewById(R.id.progressBar);
        progressBar.setMax(100);
        progressBar.setVisibility(View.VISIBLE);

        logo = relativeLayout.findViewById(R.id.logo);
        albumArtView = (RoundedImageView) relativeLayout.findViewById(R.id.albumArt);
        albumArtView.setCornerRadius((float) Config.ALBUM_ART_CORNER_RADIUS);
        albumArtView.setBorderWidth((float) Config.ALBUM_ART_BORDER_WIDTH);
        //agendapadrao = relativeLayout.findViewById(R.id.agenda_padrao);
       /// agendapadrao.setCornerRadius((float) Config.ALBUM_ART_CORNER_RADIUS);
//        agendapadrao.setBorderWidth((float) Config.ALBUM_ART_BORDER_WIDTH);

        buttonPlayPause = relativeLayout.findViewById(R.id.btn_play_pause);
        buttonPlayPause.setOnClickListener(this);

//        if(!Config.STATUS_RADIO){
//            menu_play.setVisibility(View.GONE);
//            progressBar.setVisibility(View.GONE);
//        }else{
            updateButtons();
            progressBar.setMax(100);
            progressBar.setVisibility(View.VISIBLE);
//        }

    }

    public void updateButtons() {
        if(!Config.STATUS_RADIO){
            return;
        }
        if (isPlaying() || progressBar.getVisibility() == View.VISIBLE) {
            //If another stream is playing, show this in the layout
            if (RadioManager.getService() != null && radio_url != null && !radio_url.equals(RadioManager.getService().getStreamUrl())) {
                buttonPlayPause.setImageResource(R.drawable.ic_play_white);
                relativeLayout.findViewById(R.id.already_playing_tooltip).setVisibility(View.VISIBLE);
                //If this stream is playing, adjust the buttons accordingly
            } else {
                buttonPlayPause.setImageResource(R.drawable.ic_stop);
                relativeLayout.findViewById(R.id.already_playing_tooltip).setVisibility(View.GONE);
            }
        } else {
            //If this stream is paused, adjust the buttons accordingly
            buttonPlayPause.setImageResource(R.drawable.ic_play_white);
            relativeLayout.findViewById(R.id.already_playing_tooltip).setVisibility(View.GONE);

            updateMediaInfoFromBackground(null, null);
        }

        if (isPlaying()) {
        equalizerView.animateBars();
    } else {
        equalizerView.stopBars();
    }

}

    @Override
    public void onClick(View v) {
        requestStoragePermission();
    }

    private void startStopPlaying() {
        //Start the radio playing
        radioManager.playOrPause(radio_url);
        //Update the UI
        updateButtons();
    }

    private void stopService() {
        radioManager.stopServices();
        Tools.unregisterAsListener(this);
    }

    @Override
    public void onCreateOptionsMenu(Menu menu, MenuInflater inflater) {
        inflater.inflate(R.menu.menu_main, menu);
        super.onCreateOptionsMenu(menu, inflater);
    }


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.share:
                Intent sendInt = new Intent(Intent.ACTION_SEND);
                sendInt.putExtra(Intent.EXTRA_SUBJECT, getString(R.string.app_name));
                sendInt.putExtra(Intent.EXTRA_TEXT, getString(R.string.app_name) + "\nBaixe agora na Playstore" + "\n");
                sendInt.setType("text/plain");
                startActivity(Intent.createChooser(sendInt, "Share"));
                return true;

            default:
                return super.onOptionsItemSelected(item);
        }
    }

    //@param info - the text to be updated. Giving a null string will hide the info.
    public void updateMediaInfoFromBackground(String info, Bitmap image) {
//        if(!Config.STATUS_RADIO){
//            return;
//        }
        if (info != null)
            nowPlaying.setText(info);

        if (info != null && nowPlayingTitle.getVisibility() == View.GONE) {
            nowPlayingTitle.setVisibility(View.VISIBLE);
            nowPlaying.setVisibility(View.VISIBLE);
        } else if (info == null) {
            nowPlayingTitle.setVisibility(View.VISIBLE);
            nowPlayingTitle.setText(R.string.now_playing);
            nowPlaying.setVisibility(View.VISIBLE);
            nowPlaying.setText(radio_name);
        }

        if (image != null) {
            albumArtView.setImageBitmap(image);
        } else {
            albumArtView.setImageResource(R.drawable.defaultalbum);
        }

    }

    @Override
    public String[] requiredPermissions() {
        return new String[]{Manifest.permission.READ_PHONE_STATE};
    }

    @Override
    public void onMetaDataReceived(Metadata meta, Bitmap image) {
        //Update the mediainfo shown above the controls
        String artistAndSong = null;
        if (meta != null && meta.getArtist() != null)
            artistAndSong = meta.getArtist() + " - " + meta.getSong();
        updateMediaInfoFromBackground(artistAndSong, image);
    }

    private boolean isPlaying() {
        return (null != radioManager && null != RadioManager.getService() && RadioManager.getService().isPlaying());
    }

    @Override
    public boolean supportsCollapse() {
        return false;
    }

    private void makeSnackBar(int text) {
        Snackbar bar = Snackbar.make(buttonPlayPause, text, Snackbar.LENGTH_SHORT);
        bar.show();
        ((TextView) bar.getView().findViewById(com.google.android.material.R.id.snackbar_text)).setTextColor(getResources().getColor(R.color.white));
    }

    public void onBackPressed() {
        ((MainActivity) getActivity()).setOnBackClickListener(new MainActivity.OnBackClickListener() {
            @Override
            public boolean onBackClick() {
                exitDialog();
                return true;
            }
        });
    }

    public void exitDialog() {
        AlertDialog.Builder dialog = new AlertDialog.Builder(getActivity());
        dialog.setIcon(R.mipmap.ic_launcher);
        dialog.setTitle(R.string.app_name);
        dialog.setMessage(getResources().getString(R.string.message));
        dialog.setPositiveButton(getResources().getString(R.string.quit), new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                stopService();
                getActivity().finish();
            }
        });

        dialog.setNegativeButton(getResources().getString(R.string.minimize), new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                minimizeApp();
            }
        });

        dialog.setNeutralButton(getResources().getString(R.string.cancel), new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {

            }
        });
        dialog.show();
    }

    public void minimizeApp() {
        Intent intent = new Intent(Intent.ACTION_MAIN);
        intent.addCategory(Intent.CATEGORY_HOME);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        startActivity(intent);
    }

    private void requestStoragePermission() {
        Dexter.withActivity(getActivity())
                .withPermissions(
                        Manifest.permission.READ_PHONE_STATE)
                .withListener(new MultiplePermissionsListener() {
                    @Override
                    public void onPermissionsChecked(MultiplePermissionsReport report) {
                        // check if all permissions are granted
                        if (report.areAllPermissionsGranted()) {
                            if (!isPlaying()) {
                                if (radio_url != null) {

                                    startStopPlaying();
                                    showInterstitialAd();

                                    //Check the sound level
                                    AudioManager audioManager = (AudioManager) activity.getSystemService(Context.AUDIO_SERVICE);
                                    int volume_level = audioManager.getStreamVolume(AudioManager.STREAM_MUSIC);
                                    if (volume_level < 2) {
                                        makeSnackBar(R.string.volume_low);
                                    }

                                } else {
                                    //The loading of urlToPlay should happen almost instantly, so this code should never be reached
                                    makeSnackBar(R.string.error_retry_later);
                                }
                            } else {
                                startStopPlaying();
                            }
                        }
                        // check for permanent denial of any permission
                        if (report.isAnyPermissionPermanentlyDenied()) {
                            // show alert dialog navigating to Settings
                            showSettingsDialog();
                        }
                    }

                    @Override
                    public void onPermissionRationaleShouldBeShown(List<PermissionRequest> permissions, PermissionToken token) {
                        token.continuePermissionRequest();
                    }
                }).
                withErrorListener(new PermissionRequestErrorListener() {
                    @Override
                    public void onError(DexterError error) {
                        Toast.makeText(getActivity(), "Error occurred! " + error.toString(), Toast.LENGTH_SHORT).show();
                    }
                })
                .onSameThread()
                .check();
    }

    private void showSettingsDialog() {
        AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
        builder.setTitle("Need Permissions");
        builder.setMessage("This app needs permission to use this feature. You can grant them in app settings.");
        builder.setPositiveButton("GOTO SETTINGS", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.cancel();
                openSettings();
            }
        });
        builder.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.cancel();
            }
        });
        builder.show();
    }

    private void openSettings() {
        Intent intent = new Intent(Settings.ACTION_APPLICATION_DETAILS_SETTINGS);
        Uri uri = Uri.fromParts("package", getActivity().getPackageName(), null);
        intent.setData(uri);
        startActivityForResult(intent, 101);
    }

    public void initVolumeBar() {
        appCompatSeekBar = (AppCompatSeekBar) relativeLayout.findViewById(R.id.volumeBar);

        audioManager = (AudioManager) mainActivity.getSystemService(Context.AUDIO_SERVICE);
        audioManager.setStreamVolume(AudioManager.STREAM_MUSIC, Config.DEFAULT_VOLUME, 0);

        appCompatSeekBar.setMax(audioManager.getStreamMaxVolume(AudioManager.STREAM_MUSIC));
        appCompatSeekBar.setProgress(Config.DEFAULT_VOLUME);
        appCompatSeekBar.setMax(15);

        img_volume = (ImageButton) relativeLayout.findViewById(R.id.ic_volume);
        img_volume.setImageResource(R.drawable.ic_volume);

        appCompatSeekBar.setOnSeekBarChangeListener(new AppCompatSeekBar.OnSeekBarChangeListener() {
            @Override
            public void onProgressChanged(SeekBar seekBar, int progress, boolean b) {
                audioManager.setStreamVolume(AudioManager.STREAM_MUSIC, progress, 0);

                if (progress == 0) {
                    Toast.makeText(getActivity(), "Volume OFF", Toast.LENGTH_SHORT).show();
                    img_volume.setImageResource(R.drawable.ic_volume_off);
                } else if (progress == 15) {
                    Toast.makeText(getActivity(), "Volume Max", Toast.LENGTH_SHORT).show();
                    img_volume.setImageResource(R.drawable.ic_volume);
                } else {
                    img_volume.setImageResource(R.drawable.ic_volume);
                }
            }

            @Override
            public void onStartTrackingTouch(SeekBar seekBar) {

            }

            @Override
            public void onStopTrackingTouch(SeekBar seekBar) {

            }
        });
    }

    private void loadInterstitialAd() {
        if (Config.ENABLE_ADMOB_INTERSTITIAL_ON_PLAY) {
            interstitialAd = new InterstitialAd(getActivity());
            interstitialAd.setAdUnitId(getResources().getString(R.string.admob_interstitial_unit_id));
            interstitialAd.loadAd(new AdRequest.Builder().build());
            interstitialAd.setAdListener(new AdListener() {
                @Override
                public void onAdClosed() {
                    interstitialAd.loadAd(new AdRequest.Builder().build());
                }
            });
        } else {
            Log.d("INFO", "AdMob Interstitial is Disabled");
        }
    }

    private void showInterstitialAd() {
        if (Config.ENABLE_ADMOB_INTERSTITIAL_ON_PLAY) {
            if (interstitialAd != null && interstitialAd.isLoaded()) {
                if (counter == Config.ADMOB_INTERSTITIAL_ON_PLAY_INTERVAL) {
                    interstitialAd.show();
                    counter = 1;
                } else {
                    counter++;
                }
            } else {
                Log.d("INFO", "Interstitial Ad is Disabled");
            }
        } else {
            Log.d("INFO", "AdMob Interstitial is Disabled");
        }
    }

}