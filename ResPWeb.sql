PGDMP     +            	    
    w            PWeb    11.5    11.5 I    b           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            c           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            d           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            e           1262    16393    PWeb    DATABASE     �   CREATE DATABASE "PWeb" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Mexico.1252' LC_CTYPE = 'Spanish_Mexico.1252';
    DROP DATABASE "PWeb";
             postgres    false                        2615    16394    cuerpo    SCHEMA        CREATE SCHEMA cuerpo;
    DROP SCHEMA cuerpo;
             postgres    false                        2615    24600    lecturas    SCHEMA        CREATE SCHEMA lecturas;
    DROP SCHEMA lecturas;
             postgres    false            �            1259    16395    clasif    TABLE     c   CREATE TABLE cuerpo.clasif (
    idclasif integer NOT NULL,
    nomclasif character varying(40)
);
    DROP TABLE cuerpo.clasif;
       cuerpo         postgres    false    6            �            1259    16398    clasif_idclasif_seq    SEQUENCE     |   CREATE SEQUENCE cuerpo.clasif_idclasif_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE cuerpo.clasif_idclasif_seq;
       cuerpo       postgres    false    6    198            f           0    0    clasif_idclasif_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE cuerpo.clasif_idclasif_seq OWNED BY cuerpo.clasif.idclasif;
            cuerpo       postgres    false    199            �            1259    33095 
   devicetype    TABLE     m   CREATE TABLE cuerpo.devicetype (
    iddevicetype integer NOT NULL,
    namedevice character varying(100)
);
    DROP TABLE cuerpo.devicetype;
       cuerpo         postgres    false    6            �            1259    33093    devicetype_iddevicetype_seq    SEQUENCE     �   CREATE SEQUENCE cuerpo.devicetype_iddevicetype_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE cuerpo.devicetype_iddevicetype_seq;
       cuerpo       postgres    false    213    6            g           0    0    devicetype_iddevicetype_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE cuerpo.devicetype_iddevicetype_seq OWNED BY cuerpo.devicetype.iddevicetype;
            cuerpo       postgres    false    212            �            1259    41281    empleado    TABLE     �   CREATE TABLE cuerpo.empleado (
    idemp integer NOT NULL,
    nomemp character varying(40),
    apemp character varying(60),
    telemp character varying(22)
);
    DROP TABLE cuerpo.empleado;
       cuerpo         postgres    false    6            �            1259    41279    empleado_idemp_seq    SEQUENCE     �   CREATE SEQUENCE cuerpo.empleado_idemp_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE cuerpo.empleado_idemp_seq;
       cuerpo       postgres    false    215    6            h           0    0    empleado_idemp_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE cuerpo.empleado_idemp_seq OWNED BY cuerpo.empleado.idemp;
            cuerpo       postgres    false    214            �            1259    16450    opcmenu    TABLE     �   CREATE TABLE cuerpo.opcmenu (
    idopcmenu integer NOT NULL,
    idmenu character varying(40) NOT NULL,
    nommenu character varying(100),
    orden integer
);
    DROP TABLE cuerpo.opcmenu;
       cuerpo         postgres    false    6            �            1259    16448    opcmenu_idopcmenu_seq    SEQUENCE     �   CREATE SEQUENCE cuerpo.opcmenu_idopcmenu_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE cuerpo.opcmenu_idopcmenu_seq;
       cuerpo       postgres    false    6    205            i           0    0    opcmenu_idopcmenu_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE cuerpo.opcmenu_idopcmenu_seq OWNED BY cuerpo.opcmenu.idopcmenu;
            cuerpo       postgres    false    204            �            1259    16456    perfil    TABLE     �   CREATE TABLE cuerpo.perfil (
    idrol integer NOT NULL,
    idopcmenu integer NOT NULL,
    fechahora timestamp without time zone DEFAULT now()
);
    DROP TABLE cuerpo.perfil;
       cuerpo         postgres    false    6            �            1259    16411    rol    TABLE     [   CREATE TABLE cuerpo.rol (
    idrol integer NOT NULL,
    nomrol character varying(100)
);
    DROP TABLE cuerpo.rol;
       cuerpo         postgres    false    6            �            1259    16409    rol_idrol_seq    SEQUENCE     �   CREATE SEQUENCE cuerpo.rol_idrol_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE cuerpo.rol_idrol_seq;
       cuerpo       postgres    false    6    203            j           0    0    rol_idrol_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE cuerpo.rol_idrol_seq OWNED BY cuerpo.rol.idrol;
            cuerpo       postgres    false    202            �            1259    16400    sensado    TABLE     �   CREATE TABLE cuerpo.sensado (
    idsen integer NOT NULL,
    nomsensor character varying(40),
    valor integer,
    imagen character varying(100)
);
    DROP TABLE cuerpo.sensado;
       cuerpo         postgres    false    6            �            1259    16403    sensado_idsen_seq    SEQUENCE     z   CREATE SEQUENCE cuerpo.sensado_idsen_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE cuerpo.sensado_idsen_seq;
       cuerpo       postgres    false    6    200            k           0    0    sensado_idsen_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE cuerpo.sensado_idsen_seq OWNED BY cuerpo.sensado.idsen;
            cuerpo       postgres    false    201            �            1259    24587    usuario    TABLE       CREATE TABLE cuerpo.usuario (
    idusuario integer NOT NULL,
    correousr character varying(100) NOT NULL,
    nomusr character varying(100),
    contrasena character varying(100),
    idrol integer NOT NULL,
    session character varying(60),
    imagen character varying(120)
);
    DROP TABLE cuerpo.usuario;
       cuerpo         postgres    false    6            �            1259    24585    usuario_idusuario_seq    SEQUENCE     �   CREATE SEQUENCE cuerpo.usuario_idusuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE cuerpo.usuario_idusuario_seq;
       cuerpo       postgres    false    208    6            l           0    0    usuario_idusuario_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE cuerpo.usuario_idusuario_seq OWNED BY cuerpo.usuario.idusuario;
            cuerpo       postgres    false    207            �            1259    24608    sensado    TABLE     �   CREATE TABLE lecturas.sensado (
    idsensado integer NOT NULL,
    fechahora timestamp without time zone DEFAULT now(),
    valor double precision,
    idsensor integer NOT NULL
);
    DROP TABLE lecturas.sensado;
       lecturas         postgres    false    8            �            1259    24606    sensado_idsensado_seq    SEQUENCE     �   CREATE SEQUENCE lecturas.sensado_idsensado_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE lecturas.sensado_idsensado_seq;
       lecturas       postgres    false    8    211            m           0    0    sensado_idsensado_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE lecturas.sensado_idsensado_seq OWNED BY lecturas.sensado.idsensado;
            lecturas       postgres    false    210            �            1259    24601    sensor    TABLE     e   CREATE TABLE lecturas.sensor (
    idsensor integer NOT NULL,
    nomsensor character varying(80)
);
    DROP TABLE lecturas.sensor;
       lecturas         postgres    false    8            �
           2604    16405    clasif idclasif    DEFAULT     r   ALTER TABLE ONLY cuerpo.clasif ALTER COLUMN idclasif SET DEFAULT nextval('cuerpo.clasif_idclasif_seq'::regclass);
 >   ALTER TABLE cuerpo.clasif ALTER COLUMN idclasif DROP DEFAULT;
       cuerpo       postgres    false    199    198            �
           2604    33098    devicetype iddevicetype    DEFAULT     �   ALTER TABLE ONLY cuerpo.devicetype ALTER COLUMN iddevicetype SET DEFAULT nextval('cuerpo.devicetype_iddevicetype_seq'::regclass);
 F   ALTER TABLE cuerpo.devicetype ALTER COLUMN iddevicetype DROP DEFAULT;
       cuerpo       postgres    false    212    213    213            �
           2604    41284    empleado idemp    DEFAULT     p   ALTER TABLE ONLY cuerpo.empleado ALTER COLUMN idemp SET DEFAULT nextval('cuerpo.empleado_idemp_seq'::regclass);
 =   ALTER TABLE cuerpo.empleado ALTER COLUMN idemp DROP DEFAULT;
       cuerpo       postgres    false    215    214    215            �
           2604    16453    opcmenu idopcmenu    DEFAULT     v   ALTER TABLE ONLY cuerpo.opcmenu ALTER COLUMN idopcmenu SET DEFAULT nextval('cuerpo.opcmenu_idopcmenu_seq'::regclass);
 @   ALTER TABLE cuerpo.opcmenu ALTER COLUMN idopcmenu DROP DEFAULT;
       cuerpo       postgres    false    205    204    205            �
           2604    16414 	   rol idrol    DEFAULT     f   ALTER TABLE ONLY cuerpo.rol ALTER COLUMN idrol SET DEFAULT nextval('cuerpo.rol_idrol_seq'::regclass);
 8   ALTER TABLE cuerpo.rol ALTER COLUMN idrol DROP DEFAULT;
       cuerpo       postgres    false    203    202    203            �
           2604    16406    sensado idsen    DEFAULT     n   ALTER TABLE ONLY cuerpo.sensado ALTER COLUMN idsen SET DEFAULT nextval('cuerpo.sensado_idsen_seq'::regclass);
 <   ALTER TABLE cuerpo.sensado ALTER COLUMN idsen DROP DEFAULT;
       cuerpo       postgres    false    201    200            �
           2604    24590    usuario idusuario    DEFAULT     v   ALTER TABLE ONLY cuerpo.usuario ALTER COLUMN idusuario SET DEFAULT nextval('cuerpo.usuario_idusuario_seq'::regclass);
 @   ALTER TABLE cuerpo.usuario ALTER COLUMN idusuario DROP DEFAULT;
       cuerpo       postgres    false    207    208    208            �
           2604    24611    sensado idsensado    DEFAULT     z   ALTER TABLE ONLY lecturas.sensado ALTER COLUMN idsensado SET DEFAULT nextval('lecturas.sensado_idsensado_seq'::regclass);
 B   ALTER TABLE lecturas.sensado ALTER COLUMN idsensado DROP DEFAULT;
       lecturas       postgres    false    211    210    211            N          0    16395    clasif 
   TABLE DATA               5   COPY cuerpo.clasif (idclasif, nomclasif) FROM stdin;
    cuerpo       postgres    false    198   7L       ]          0    33095 
   devicetype 
   TABLE DATA               >   COPY cuerpo.devicetype (iddevicetype, namedevice) FROM stdin;
    cuerpo       postgres    false    213   yL       _          0    41281    empleado 
   TABLE DATA               @   COPY cuerpo.empleado (idemp, nomemp, apemp, telemp) FROM stdin;
    cuerpo       postgres    false    215   �L       U          0    16450    opcmenu 
   TABLE DATA               D   COPY cuerpo.opcmenu (idopcmenu, idmenu, nommenu, orden) FROM stdin;
    cuerpo       postgres    false    205   �L       V          0    16456    perfil 
   TABLE DATA               =   COPY cuerpo.perfil (idrol, idopcmenu, fechahora) FROM stdin;
    cuerpo       postgres    false    206   �M       S          0    16411    rol 
   TABLE DATA               ,   COPY cuerpo.rol (idrol, nomrol) FROM stdin;
    cuerpo       postgres    false    203   N       P          0    16400    sensado 
   TABLE DATA               B   COPY cuerpo.sensado (idsen, nomsensor, valor, imagen) FROM stdin;
    cuerpo       postgres    false    200   QN       X          0    24587    usuario 
   TABLE DATA               c   COPY cuerpo.usuario (idusuario, correousr, nomusr, contrasena, idrol, session, imagen) FROM stdin;
    cuerpo       postgres    false    208   &O       [          0    24608    sensado 
   TABLE DATA               J   COPY lecturas.sensado (idsensado, fechahora, valor, idsensor) FROM stdin;
    lecturas       postgres    false    211   Q       Y          0    24601    sensor 
   TABLE DATA               7   COPY lecturas.sensor (idsensor, nomsensor) FROM stdin;
    lecturas       postgres    false    209   �Q       n           0    0    clasif_idclasif_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('cuerpo.clasif_idclasif_seq', 31, true);
            cuerpo       postgres    false    199            o           0    0    devicetype_iddevicetype_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('cuerpo.devicetype_iddevicetype_seq', 10, true);
            cuerpo       postgres    false    212            p           0    0    empleado_idemp_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('cuerpo.empleado_idemp_seq', 2, true);
            cuerpo       postgres    false    214            q           0    0    opcmenu_idopcmenu_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('cuerpo.opcmenu_idopcmenu_seq', 13, true);
            cuerpo       postgres    false    204            r           0    0    rol_idrol_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('cuerpo.rol_idrol_seq', 11, true);
            cuerpo       postgres    false    202            s           0    0    sensado_idsen_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('cuerpo.sensado_idsen_seq', 34, true);
            cuerpo       postgres    false    201            t           0    0    usuario_idusuario_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('cuerpo.usuario_idusuario_seq', 24, true);
            cuerpo       postgres    false    207            u           0    0    sensado_idsensado_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('lecturas.sensado_idsensado_seq', 15, true);
            lecturas       postgres    false    210            �
           2606    41278 
   sensado pk 
   CONSTRAINT     K   ALTER TABLE ONLY cuerpo.sensado
    ADD CONSTRAINT pk PRIMARY KEY (idsen);
 4   ALTER TABLE ONLY cuerpo.sensado DROP CONSTRAINT pk;
       cuerpo         postgres    false    200            �
           2606    16408    clasif pkclasif 
   CONSTRAINT     S   ALTER TABLE ONLY cuerpo.clasif
    ADD CONSTRAINT pkclasif PRIMARY KEY (idclasif);
 9   ALTER TABLE ONLY cuerpo.clasif DROP CONSTRAINT pkclasif;
       cuerpo         postgres    false    198            �
           2606    33100    devicetype pkdev 
   CONSTRAINT     X   ALTER TABLE ONLY cuerpo.devicetype
    ADD CONSTRAINT pkdev PRIMARY KEY (iddevicetype);
 :   ALTER TABLE ONLY cuerpo.devicetype DROP CONSTRAINT pkdev;
       cuerpo         postgres    false    213            �
           2606    41286    empleado pkemp 
   CONSTRAINT     O   ALTER TABLE ONLY cuerpo.empleado
    ADD CONSTRAINT pkemp PRIMARY KEY (idemp);
 8   ALTER TABLE ONLY cuerpo.empleado DROP CONSTRAINT pkemp;
       cuerpo         postgres    false    215            �
           2606    16455    opcmenu pkopc 
   CONSTRAINT     R   ALTER TABLE ONLY cuerpo.opcmenu
    ADD CONSTRAINT pkopc PRIMARY KEY (idopcmenu);
 7   ALTER TABLE ONLY cuerpo.opcmenu DROP CONSTRAINT pkopc;
       cuerpo         postgres    false    205            �
           2606    16461    perfil pkperfil 
   CONSTRAINT     [   ALTER TABLE ONLY cuerpo.perfil
    ADD CONSTRAINT pkperfil PRIMARY KEY (idrol, idopcmenu);
 9   ALTER TABLE ONLY cuerpo.perfil DROP CONSTRAINT pkperfil;
       cuerpo         postgres    false    206    206            �
           2606    16416 	   rol pkrol 
   CONSTRAINT     J   ALTER TABLE ONLY cuerpo.rol
    ADD CONSTRAINT pkrol PRIMARY KEY (idrol);
 3   ALTER TABLE ONLY cuerpo.rol DROP CONSTRAINT pkrol;
       cuerpo         postgres    false    203            �
           2606    24592    usuario pkusr 
   CONSTRAINT     R   ALTER TABLE ONLY cuerpo.usuario
    ADD CONSTRAINT pkusr PRIMARY KEY (idusuario);
 7   ALTER TABLE ONLY cuerpo.usuario DROP CONSTRAINT pkusr;
       cuerpo         postgres    false    208            �
           2606    24594    usuario usuario_correousr_key 
   CONSTRAINT     ]   ALTER TABLE ONLY cuerpo.usuario
    ADD CONSTRAINT usuario_correousr_key UNIQUE (correousr);
 G   ALTER TABLE ONLY cuerpo.usuario DROP CONSTRAINT usuario_correousr_key;
       cuerpo         postgres    false    208            �
           2606    24605    sensor pksen 
   CONSTRAINT     R   ALTER TABLE ONLY lecturas.sensor
    ADD CONSTRAINT pksen PRIMARY KEY (idsensor);
 8   ALTER TABLE ONLY lecturas.sensor DROP CONSTRAINT pksen;
       lecturas         postgres    false    209            �
           2606    24614    sensado pksensa 
   CONSTRAINT     V   ALTER TABLE ONLY lecturas.sensado
    ADD CONSTRAINT pksensa PRIMARY KEY (idsensado);
 ;   ALTER TABLE ONLY lecturas.sensado DROP CONSTRAINT pksensa;
       lecturas         postgres    false    211            �
           2606    16467    perfil fkmenu    FK CONSTRAINT     w   ALTER TABLE ONLY cuerpo.perfil
    ADD CONSTRAINT fkmenu FOREIGN KEY (idopcmenu) REFERENCES cuerpo.opcmenu(idopcmenu);
 7   ALTER TABLE ONLY cuerpo.perfil DROP CONSTRAINT fkmenu;
       cuerpo       postgres    false    205    2754    206            �
           2606    16462    perfil fkrol    FK CONSTRAINT     j   ALTER TABLE ONLY cuerpo.perfil
    ADD CONSTRAINT fkrol FOREIGN KEY (idrol) REFERENCES cuerpo.rol(idrol);
 6   ALTER TABLE ONLY cuerpo.perfil DROP CONSTRAINT fkrol;
       cuerpo       postgres    false    2752    206    203            �
           2606    24595    usuario fkusr    FK CONSTRAINT     k   ALTER TABLE ONLY cuerpo.usuario
    ADD CONSTRAINT fkusr FOREIGN KEY (idrol) REFERENCES cuerpo.rol(idrol);
 7   ALTER TABLE ONLY cuerpo.usuario DROP CONSTRAINT fkusr;
       cuerpo       postgres    false    2752    203    208            �
           2606    24615    sensado fksen    FK CONSTRAINT     x   ALTER TABLE ONLY lecturas.sensado
    ADD CONSTRAINT fksen FOREIGN KEY (idsensor) REFERENCES lecturas.sensor(idsensor);
 9   ALTER TABLE ONLY lecturas.sensado DROP CONSTRAINT fksen;
       lecturas       postgres    false    211    209    2762            N   2   x�3�I-�,�2�y�\����E%��&���+�V����kks��qqq E��      ]   &   x�3�tD\�Ȃ\f��(��]�]�] F��� =:P      _   8   x�3�t�I����/J�4426153��4�2��(M��tJ�)�0�072"�=... ;}q      U   �   x�5�M
�0��oN� i���KADwnBLa vBc��G�bf�]̼��c!�)w�%W��Z�>��~��y��{Ԇvj��1���Eg�(2VM?�yt�\aU���q�?67�/��圠e�M2?�%��-��"a9i      V   u   x�m���0�s<E� J�>������x{ I\�L����5]X13�>0�4A{v�Μ���-Ʃ��yB��a�wvk/�~ם���,�*����w겔�֎�1�|�.p      S   )   x�3�tL����,.)JL�/�2�tN,()-
$r��qqq �[
�      P   �   x�u���0E׷Cx�.���֥�u "����`�Hy��s�[��f D>���q�^�ބ����{"�K�����g'`�B:�EL�وs#fB�{u���P��yV��<�s�V��|��eM	�!b<E0�Eq!�X�[����ڗmH��j��6@nj})/����W��(u���MWBM���d2�'O�����      X   �  x����n�@�ᵹ�,X�͌wI�
�((R�͟�`c�?�w�k�Ս������Y>z�k�&-�b$��Wp�[�\5V�\�6�:>�����c��9����n�n��њ��f��3.����C�E���i"J�4I�v�"w�3�^�MS�E�����ݗ�=���5�]�|m��v�m���J���}���.������U!�+���/�L���A�e�ޤ�Ȕ����t�=ӹ6�Taq�l�e�]��I��|��9��x~�[V��}h�S�J���k�h��Z�c���{�`�?�[�Uq�F}�k\�f�����(땫'q��;��e1�볗�1�rNڶ��o�-��M�n��h89&*�����l�����˙���a�z����WG�f��9j9&�"�%SrO�'8�
�W$�3�k)ll���4���6�5>ʽ�N�����g      [   �   x�����0ߦ�4ˋI�%��q8�J�P$���jQ���f;�6�oT5��- ����sG=�"�#M2O:�O�����+F��&��-,͸�,Ə�7qNH�!bk�%	�>^��l��a�ȿoX6D]��~8�^      Y   %   x�3�I�-H-J,)-J�2��(�MMIL����� �t     