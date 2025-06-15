<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Login user dengan email dan password.
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if (empty($data['email']) || empty($data['password'])) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Email dan password harus diisi',
            ], 400);
        }
        try {
            if (!$token = Auth::guard('api')->attempt($data)) {
                return response()->json([
                    'status_code' => 401,
                    'message' => 'Email atau password salah',
                ], 401);
            }
            $user = Auth::guard('api')->user();
            return response()->json([
                'status_code' => 200,
                'message' => 'Login berhasil',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'is_admin' => $user->is_admin,
                    ],
                    'token' => $token,
                ],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Terjadi kesalahan',
            ], 500);
        }
    }

    /**
     * Logout user yang sedang login.
     */
    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout user yang sedang login",
     *     tags={"Auth"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil logout",
     *         @OA\JsonContent(
     *             @OA\Property(property="status_code", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Logout berhasil. Token telah dihapus.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
        'status_code' => 200,
            'message' => 'Logout berhasil. Token telah dihapus.',
            ], 200);
    }

    /**
     * Logout pengguna yang sedang login.
     *
     * Menghapus token JWT agar tidak bisa digunakan lagi.
     */
    #[Response(
    status: 200,
    content: [
        'status_code' => 200,
        'message' => 'Logout berhasil. Token telah dihapus.'
    ]
    )]
    #[Response(
    status: 500,
    content: [
        'status_code' => 500,
        'message' => 'Gagal logout, terjadi kesalahan.'
    ]
    )]
    public function logoutJwt(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(
            [
                'status_code' => 200,
                'message' => 'Logout berhasil. Token telah dihapus.'
            ], 200);
        } catch (Exception $e) {
            return response()->json(
            [
                'status_code' => 500,
                'message' => 'Gagal logout, terjadi kesalahan '
            ],
            500);
        }
    }
}
